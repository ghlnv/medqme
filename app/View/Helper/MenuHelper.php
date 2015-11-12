<?php
class MenuHelper extends AppHelper { 
    var $helpers = array('Html', 'Js', 'Form', 'Text', 'Number', 'Usuarios'); 

	// #########################################################################
	// Métodos #################################################################
	public function empresas() {
		return $this->li('Empresas',
			[
				'admin' => false,
				'controller' => 'empresas',
				'action' => 'index',
			],
			[
				'title' => 'Empresas',
			]
		);
	}
	public function vagas() {
		return $this->li('Vagas',
			[
				'admin' => false,
				'controller' => 'vagas',
				'action' => 'index',
			],
			[
				'title' => 'Vagas',
			]
		);
	}
	public function li($label, $url, $options = []) {
		$ret = '';
		$ret.= $this->Html->tag('li');
		$ret.= $this->Html->link($label, $url, $options);
		$ret.= $this->Html->tag('/li');
		return $ret;
	}
	public function formLogin() {
		if('usuarios' == $this->request->params['controller']
		&& 'login' == $this->request->params['action']) {
			return false;
		}
		$ret = '';
		$ret.= $this->Form->create('Usuario', array(
			'url' => array(
				'controller' => 'usuarios',
				'action' => 'login',
			),
			'style' => 'padding: 0 20px 25px; font-size: 0.9em;',
		));

		$ret.= $this->Html->tag('div', null, ['style' => 'display: inline-block; width: 42%;']);
		$ret.= $this->Form->input('login', array(
			'label' => 'Login',
			'class' => 'form-control',
		));
		$ret.= $this->Html->tag('/div');
		
		$ret.= $this->Html->tag('div', null, ['style' => 'display: inline-block; width: 42%;']);
		$ret.= $this->Form->input('senha', array(
			'label' => 'Senha', 
			'class' => 'form-control',
			'type' => 'password',
		));
		$ret.= $this->Html->tag('/div');

		$ret.= $this->Html->tag('div', null, ['style' => 'display: inline-block; width: 16%;']);
		$ret.= $this->Form->submit('Entrar', array(
			'div' => array(
				'class' => 'input',
				'style' => 'clear: none;',
			),
			'class' => 'btn btn-primary',
			'style' => 'margin-top: 23px; width: 100%;',
		));
		$ret.= $this->Html->tag('/div');

		$ret.= $this->Usuarios->linkParaEsqueciMinhaSenha();
		$ret.= $this->Form->end();
		return $ret;
	}
	public function login() {
		$sairLabel = '';
		$sairLabel.= $this->Html->tag('i', '', ['class' => 'fa fa-sign-in']);
		$sairLabel.= ' Login';
		
		return $this->li($sairLabel,
			[
				'admin' => false,
				'controller' => 'usuarios',
				'action' => 'login',
			],
			[
				'title' => 'Entrar no sistema',
				'escape' => false,
			]
		);
	}
	public function logout() {
		$sairLabel = '';
		$sairLabel.= $this->Html->tag('i', '', ['class' => 'fa fa-sign-out']);
		$sairLabel.= ' Sair';
		
		return $this->li($sairLabel,
			[
				'admin' => false,
				'controller' => 'usuarios',
				'action' => 'sair',
			],
			[
				'title' => 'Entrar no sistema',
				'escape' => false,
			]
		);
	}
	public function perfil($pessoa) {
		if(!$pessoa) {
			return false;
		}
		$userLabel = '';
		$userLabel.= $this->Html->tag('i', '', ['class' => 'fa fa-user']);
		$userLabel.= ' ';
		$userLabel.= $pessoa['Pessoa']['nome'];
		echo $this->li($userLabel,
			[
				'admin' => false,
				'controller' => 'pessoas',
				'action' => 'meuPerfil',
			],
			[
				'title' => 'Alterar dados do perfil',
				'escape' => false,
			]
		);
	}
	
	// #########################################################################
	// Métodos privados ########################################################
}