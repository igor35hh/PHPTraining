<?php
	
	class the_comments extends Module {

		public function __construct() {
			$this->name = 'the_comments';
			$this->tab = 'front_office_features';
			$this->version = '0.2';
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

			if (!parent::install() || !$this->registerHook('displayProductTabContent') || !$this->registerHook('displayBackOfficeHeader'))
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

		public function hookDisplayBackOfficeHeader($params) {
			if(Tools::getValue('controller') != 'AdminModules') {
				return '';
			}
			$this->context->smarty->assign('pc_base_dir', __PS_BASE_URI__.'modules/'.$this->name.'/');
			return $this->display(__FILE__,'displayBackOfficeHeader.tpl');
		}

		public function processProductTabContent() {
			if(Tools::isSubmit('mymod_pc_submit_comment')) {
				$id_product = Tools::getValue('id_product');
				$firstname = Tools::getValue('firstname');
				$lastname = Tools::getValue('lasttname');
				$email = Tools::getValue('email');
			 	$grade = Tools::getValue('grade');
			 	$comment = Tools::getValue('comment');
			 	$insert = array (
			 		'id_product' => (int)$id_product,
			 		'firstname' => pSQL($firstname),
			 		'lastname' => pSQL($lastname),
			 		'email' => pSQL($email),
			 		'grade' => (int)$grade,
			 		'comment' => pSQL($comment),
			 		'date_add' => date('Y-m-d H:i:s'),
			 	);
			 	Db::getInstance()->insert('mymod_comment', $insert);
			 	$this->context->smarty->assign('new_comment_posted', 'true');
			}
		}

		public function assignProductTabContent() {
			$enable_grades = Configuration::get('MYMOD_GRADES');
			$enable_comments = Configuration::get('MYMOD_COMMENTS');

			$id_product = Tools::getValue('id_product');
			$comments = Db::getInstance()->executeS('SELECT * FROM `'._DB_PREFIX_.'mymod_comment` 
				WHERE `id_product`='.(int)$id_product);

			$this->context->controller->addCSS($this->_path.'views/css/star-rating.css', 'all');
			$this->context->controller->addJS($this->_path.'views/js/star-rating.js');

			$this->context->controller->addCSS($this->_path.'views/css/mymodcomments.css', 'all');
			$this->context->controller->addJS($this->_path.'views/js/mymodcomments.js');

			//die($this->_path.'views/js/mymodcomments.js');

			$this->context->smarty->assign('enable_grades', $enable_grades);
			$this->context->smarty->assign('enable_comments', $enable_comments);
			$this->context->smarty->assign('comments', $comments);
		}

		public function hookDisplayProductTabContent($params) {
			$this->processProductTabContent();
			$this->assignProductTabContent();
			return $this->display(__FILE__, 'displayProductTabContent.tpl');
		}

		public function processConfiguration() {
			if(Tools::isSubmit('mymod_pc_form')) {
				$enable_grades = Tools::getValue('enable_grades');
				$enable_comments = Tools::getValue('enable_comments');
				Configuration::updateValue('MYMOD_GRADES', $enable_grades);
				Configuration::updateValue('MYMOD_COMMENTS', $enable_comments);
				$this->context->smarty->assign('confirmation', 'ok');
			}
		}

		public function assignConfiguration() {
			$enable_grades = Configuration::get('MYMOD_GRADES');
			$enable_comments = Configuration::get('MYMOD_COMMENTS');
			$this->context->smarty->assign('enable_grades', $enable_grades);
			$this->context->smarty->assign('enable_comments', $enable_comments);
		}

		public function getContent() {
			$this->processConfiguration();
			$this->assignConfiguration();
			return $this->display(__FILE__,'getContent.tpl');
		}

	}

?>