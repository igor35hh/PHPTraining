<?php

class MyModPayment extends PaymentModule {

	public function __construct() {
		$this->name = 'mymodpayment';
		$this->tab = 'payments_gateways';
		$this->version = '0.1';
		$this->author = 'Igor Klimets';
		$this->bootstrap = true;
		parent::__construct();
		$this->displayName = $this->l('MyMod payment');
		$this->description = $this->l('A simple payment module');
	}

	public function install() {
		if (!parent::install() || !$this->registerHook('displayPayment') || !$this->registerHook('displayPaymentReturn'))
			return false;

		if (!$this->installOrderState())
			return false;

		return true;

	}

	public function hookDisplayPayment($params) {
		$controller = $this->getHookController('displayPayment');
		return $controller->run($params);
	}

	public function getContent() {
		$controller = $this->getHookController('getContent');
		return $controller->run();
	}

	public function hookDisplayPaymentReturn($params) {
		$controller = $this->getHookController('displayPaymentReturn');
		return $controller->run($params);
	}

	public function installOrderState() {
		if (Configuration::get('PS_OS_MYMOD_PAYMENT') < 1) {
			$order_state = new OrderState();
			$order_state->send_email = true;
			$order_state->module_name = $this->name;
			$order_state->invoice = false;
			$order_state->color = '#98c3ff';
			$order_state->logable = true;
			$order_state->shipped = false;
			$order_state->unremovable = false;
			$order_state->delivery = false;
			$order_state->hidden = false;
			$order_state->paid = false;
			$order_state->deleted = false;
			$order_state->name = array((int)Configuration::get('PS_LANG_DEFAULT') => pSQL($this->l('MyMod Payment - Awaiting confirmation')));
			$order_state->template = array();
			foreach (LanguageCore::getLanguages() as $l) {
				$order_state->template[$l['id_lang']] = 'mymodpayment';
			}

			foreach (LanguageCore::getLanguages() as $l) {
				$module_path = dirname(__FILE__).'/views/templates/mails/'.$l['iso_code'].'/';
				$application_path = dirname(__FILE__).'/../../mails/'.$l['iso_code'].'/';
				if (!copy($module_path.'mymodpayment.txt', $application_path.'mymodpayment.txt') ||
					!copy($module_path.'mymodpayment.html', $application_path.'mymodpayment.html'))
						return false;
			}

			if ($order_state->add()) {
				Configuration::updateValue('PS_OS_MYMOD_PAYMENT', $order_state->id);
				copy(dirname(__FILE__).'/logo.gif', dirname(__FILE__).'/../../img/os/'.$order_state->id.'.gif');
				copy(dirname(__FILE__).'/logo.gif', dirname(__FILE__).'/../../img/tmp/order_state_mini_'.$order_state->id.'.gif');
			} else {
				return false;
			}
		}

		return true;
	}



}

?>