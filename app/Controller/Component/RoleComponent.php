<?php
class RoleComponent extends Object {

	var $components = array();
	var $controller;
	
	public function __construct() {
        parent::__construct();
    }
	public function beforeRedirect() {}
	public function initialize(&$controller) {
		$this->controller = $controller;
		$this->controller->set('role', $this);
	}
	public function startup(&$controller) {}
	public function beforeRender(&$controller) {}
	public function shutdown(&$controller) {}
	
   // ###############################################################
   // Verificações específicas ######################################
	public function isAdmin() {
		return 1 == AuthComponent::user('id');
	}
	public function isEstudante() {
		if (SessionComponent::check('Usuario.estudante')) {
			return SessionComponent::read('Usuario.estudante');
		}
		$this->controller->loadModel('Usuario');
		$permissao = 'Estudante' == $this->controller->Usuario->field('tipo', [
			'conditions' => ['id' => AuthComponent::user('id')],
			'contain' => false,
		]);
		SessionComponent::write('Usuario.estudante', $permissao);
		return $permissao;
	}
	public function isSaude() {
		if (SessionComponent::check('Usuario.saude')) {
			return SessionComponent::read('Usuario.saude');
		}
		$this->controller->loadModel('Usuario');
		$permissao = 'Profissional de Saúde' == $this->controller->Usuario->field('tipo', [
			'conditions' => ['id' => AuthComponent::user('id')],
			'contain' => false,
		]);
		SessionComponent::write('Usuario.saude', $permissao);
		return $permissao;
	}
	public function getPessoa() {
		if (SessionComponent::check('Pessoa')) {
			return SessionComponent::read('Pessoa');
		}
		$pessoa = $this->getPessoaRole();
		if(!empty($pessoa)) {
			SessionComponent::write('Pessoa', $pessoa);
			return $pessoa;
		}
		return false;
	}
	public function updatePessoa() {
		$pessoa = $this->getPessoaRole();
		if(!empty($pessoa)) {
			SessionComponent::write('Pessoa', $pessoa);
		}
	}
	public function error() {
		$this->controller->Session->setFlash($this->controller->Auth->authError);
		$this->controller->redirect($this->controller->referer());
	}
	
	// #########################################################################
	// Métodos privados ########################################################
	public function getPessoaRole() {
		$this->controller->loadModel('Pessoa');
		return $this->controller->Pessoa->find('first', array(
			'fields' => array(
				'Pessoa.id',
				'Pessoa.nome',
				'Pessoa.email',
			),
			'conditions' => [
				'Pessoa.id' => AuthComponent::user('pessoa_id'),
			],
			'contain' => false,
		));
	}
}