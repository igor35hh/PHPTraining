<?php

	class MyModCommentsDisplayBackOfficeHeaderController {
		public function __construct($module, $file, $path) {
			$this->file = $file;
			$this->module = $module;
			$this->context = Context::getContext(); 
			$this->_path = $path;
		}

		public function run($params) {
			if (Tools::getValue('controller') != 'AdminModules')
				return '';
			$this->context->smarty->assign('pc_base_dir', __PS_BASE_URI__.'modules/'.$this->module->name.'/');
			return $this->module->display($this->file, 'displayBackOfficeHeader.tpl');
		}
	}

?>	