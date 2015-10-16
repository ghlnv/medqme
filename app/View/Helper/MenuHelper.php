<?php
class MenuHelper extends AppHelper { 
    var $helpers = array('Html', 'Js', 'Form', 'Text', 'Number'); 

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