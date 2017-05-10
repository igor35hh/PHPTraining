<?php

	require_once(dirname(__FILE__). '/classes/MyModComment.php');
	
	class mymodcomments extends Module {

		public function __construct() {
			$this->name = 'mymodcomments';
			$this->tab = 'front_office_features';
			$this->version = '0.3';
			$this->author = 'Igor Klimets';

			$this->bootstrap = true;
			parent::__construct();

			$this->displayName = $this->l('My Module of product comments');
			$this->description = $this->l(
				'With this module your customer will be able to grade and comments your products');
			
		}

		public function install() {

			//parent::install();
			//$this->registerHook('displayProductTabContent');
			//return true;

			if(!$this->installTab('AdminCatalog', 'AdminMyModComments', 'MyMod Comments')) {
				return false;
			}

			if (!parent::install() || 
				!$this->registerHook('displayProductTabContent') || 
				!$this->registerHook('displayBackOfficeHeader') ||
				!$this->registerHook('displayAdminProductsExtra') ||
				!$this->registerHook('displayAdminCustomers') || 
				!$this->registerHook('ModuleRoutes'))
				return false;

			$sql_file = dirname(__FILE__).'/install/install.sql';
			if(!$this->loadSQLFile($sql_file))
				return false;

			Configuration::updateValue('MYMOD_GRADES', '1');
			Configuration::updateValue('MYMOD_COMMENTS', '1');

			return true;

			// return Db::getInstance()->execute('
			// 	CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'mymod_comment` (
			// 		id_mymod_comment int(11) NOT NULL AUTO_INCREMENT,
			// 		id_product int(11) NOT NULL,
			// 		grade tinyint(1) NOT NULL,
			// 		comment text NOT NULL,date_add datetime NOT NULL,
			// 		PRIMARY KEY (id_mymod_comment)) ENGINE='._MYSQL_ENGINE_.'
			// 		DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');

		}

		public function uninstall() {
			if (!parent::uninstall())
				return false;

			$sql_file = dirname(__FILE__).'/install/uninstall.sql';
			if(!$this->loadSQLFile($sql_file))
				return false;

			if (!$this->uninstallTab('AdminMyModComments'))
			return false;

			Configuration::deleteByName('MYMOD_GRADES');
			Configuration::deleteByName('MYMOD_COMMENTS');

			return true;

			//return (Db::getInstance()->execute('DROP TABLE `'._DB_PREFIX_.'mymod_comment`'));
		}

		public function loadSQLFile($sql_file) {
			$sql_content = file_get_contents($sql_file);
			$sql_content = str_replace('PREFIX_', _DB_PREFIX_, $sql_content);
			$sql_requests = preg_split("/;\s*[\r\n]+/", $sql_content);

			$result = true;
			foreach ($sql_requests as $request) {
				if(!empty($request))
					$result &= DB::getInstance()->execute(trim($request));
			}
			return $result;
		}

		public function onClickOption($type, $href = false) {
			$confirm_reset = $this->l('Reseting this module will delete all comments from database, are you sure?');
			$reset_callback = "return mymodcomments_reset('".addcslashes($confirm_reset)."');";
			$matchType = array(
				'reset' => $reset_callback,
				'delete' => "return confirm('Confirm delete?')",
			);
			if(isset($matchType[$type])) {
				return $matchType[$type];
			}
			return '';
		}

		public function getHookController($hook_name) {
			require_once(dirname(__FILE__).'/controllers/hook/'. $hook_name.'.php');
			$controller_name = $this->name.$hook_name.'Controller';
			$controller = new $controller_name($this, __FILE__, $this->_path);
			return $controller;
		}

		public function hookDisplayBackOfficeHeader($params) {
			$controller = $this->getHookController('displayBackOfficeHeader');
			return $controller->run($params);
			// if(Tools::getValue('controller') != 'AdminModules') {
			// 	return '';
			// }
			// $this->context->smarty->assign('pc_base_dir', __PS_BASE_URI__.'modules/'.$this->name.'/');
			// return $this->display(__FILE__,'displayBackOfficeHeader.tpl');
		}

		public function hookModuleRoutes() {
			$controller = $this->getHookController('modulesRoutes');
			return $controller->run();
		}

		public function hookDisplayProductTabContent($params) {
			$controller = $this->getHookController('displayProductTabContent');
			return $controller->run($params);
			// $this->processProductTabContent();
			// $this->assignProductTabContent();
			// return $this->display(__FILE__, 'displayProductTabContent.tpl');
		}

		public function getContent() {
			$ajax_hook = Tools::getValue('ajax_hook');
			if ($ajax_hook != '')
			{
				$ajax_method = 'hook'.ucfirst($ajax_hook);
				if (method_exists($this, $ajax_method))
					die($this->{$ajax_method}(array()));
			}

			$controller = $this->getHookController('getContent');
			return $controller->run();
		}

		public function installTab($parent, $class_name, $name) {
			$tab = new Tab();
			$tab->id_parent = (int)Tab::getIdFromClassName($parent);
			$tab->name = array();
			foreach (Language::getLanguages(true) as $lang)
				$tab->name[$lang['id_lang']] = $name;
			$tab->class_name = $class_name;
			$tab->module = $this->name;
			$tab->active = 1;
			return $tab->add();
		}

		public function uninstallTab($class_name) {
			$id_tab = (int)Tab::getIdFromClassName($class_name);
			$tab = new Tab((int)$id_tab);
			return $tab->delete();
		}

		public function hookDisplayAdminProductsExtra($params) {
			$controller = $this->getHookController('displayAdminProductsExtra');
			return $controller->run();
		}

		public function hookDisplayAdminCustomers($params) {
			$controller = $this->getHookController('displayAdminCustomers');
			return $controller->run();
		}

	}

?>