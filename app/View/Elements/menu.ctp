<?php
if(AuthComponent::user()) {
	// logado ##################################################################
	echo $this->Html->tag('ul', null, ['class' => 'nav navbar-nav']);
	
	// admin ###############################################################
	if($role->isAdmin()) {
		echo $this->Menu->li('Medicamentos',
			[
				'admin' => true,
				'controller' => 'medicamentos',
				'action' => 'index',
			],
			[
				'title' => 'Gerenciar medicamentos',
			]
		);
		echo $this->Menu->li('Pessoas',
			[
				'admin' => true,
				'controller' => 'pessoas',
				'action' => 'index',
			],
			[
				'title' => 'Gerenciar pessoas',
			]
		);
	}
	// paciente #############################################################
	else {
		echo $this->Menu->li('Minhas receitas',
			[
				'admin' => false,
				'controller' => 'receitas',
				'action' => 'index',
			],
			[
				'title' => 'Minhas receitas',
			]
		);
	}
	echo $this->Html->tag('/ul');
	
	// perfil e logout #########################################################
	echo $this->Html->tag('ul', null, ['class' => 'nav navbar-nav navbar-right']);
	echo $this->Menu->perfil($role->getPessoa());
	echo $this->Menu->logout();
	echo $this->Html->tag('/ul');
}
else {
	// deslogado ###############################################################
	echo $this->Html->tag('ul', null, ['class' => 'nav navbar-nav']);
	echo $this->Html->tag('/ul');

	echo $this->Html->tag('ul', null, ['class' => 'nav navbar-nav navbar-right']);
	echo $this->Menu->formLogin();
	echo $this->Html->tag('/ul');
}