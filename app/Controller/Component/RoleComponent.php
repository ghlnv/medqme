<?php
class RoleComponent extends Object {

	var $components = array();
	var $controller;
	
	function __construct(ComponentCollection $collection, $settings = array()) {
        parent::__construct($collection, $settings);
    }
	function beforeRedirect() {
		
	}
	function initialize(&$controller) {
		$this->controller = $controller;
		$this->controller->set('role', $this);
	}
	function startup(&$controller) {}
	function beforeRender(&$controller) {}
	function shutdown(&$controller) {}
	
   // ###############################################################
   // Verificações específicas ######################################
	public function isAdmin() {
		if(1 == AuthComponent::user('id')) {
			return true;
		}
		return false;
	}
	public function getPessoa() {
		if (SessionComponent::check('Usuario.Pessoa')) {
			return SessionComponent::read('Usuario.Pessoa');
		}
		$this->controller->loadModel('Pessoa');
		$pessoa = $this->controller->Pessoa->getRole(AuthComponent::user('pessoa_id'));
		if(!empty($pessoa)) {
			SessionComponent::write('Usuario.Pessoa', $pessoa);
			return $pessoa;
		}
		return false;
	}
	public function updatePessoa() {
		$this->controller->loadModel('Pessoa');
		$pessoa = $this->controller->Pessoa->getRole(AuthComponent::user('pessoa_id'));
		if(!empty($pessoa)) {
			SessionComponent::write('Usuario.Pessoa', $pessoa);
		}
	}
	public function error() {
		$this->controller->Session->setFlash($this->controller->Auth->authError);
		$this->controller->redirect($this->controller->referer());
	}
	
	// #########################################################################
	// Outras verificações #####################################################
}