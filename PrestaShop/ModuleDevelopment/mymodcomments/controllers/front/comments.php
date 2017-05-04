<?php
	
	class MyModCommentsCommentsModuleFrontController extends ModuleFrontController {

		public $product;

		public function initContent() {
			parent::initContent();

			$id_product = (int)Tools:getValue('id_product');
			$module_action = Tools:getValue('module_action');
			$actions_list = array('list' => 'initList');
			$this->product = new Product((int)$id_product, false, $this->context->cookie->id_lang);

			if($id_product > 0 && isset($actions_list[$module_action]))
				$this->$actions_list[$module_action]();
		}

		public function initList() {

			$comments = Db::getInstance()->executeS('
				SELECT * FROM `'._DB_PREFIX_.'mymod_comment`
				WHERE `id_product` = '.(int)$this->product->id.'
				ORDER BY `date_add` DESC');

			$this->context->smarty->assign('comments', $comments);
			$this->context->smarty->assign('product', $this->product);
			
			$this->setTemplate('list.tpl');
		}

		public function setMedia() {
			parent::setMedia();
			$this->path = __PS_BASE_URI__.'modules/mymodcomments/';

			$this->context->controller->addCSS($this->_path.'views/css/star-rating.css', 'all');
			$this->context->controller->addJS($this->_path.'views/js/star-rating.js');

			$this->context->controller->addCSS($this->_path.'views/css/mymodcomments.css', 'all');
			$this->context->controller->addJS($this->_path.'views/js/mymodcomments.js');
		}

	}

?>