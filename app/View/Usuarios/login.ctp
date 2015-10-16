<?php 
echo $this->Html->tag('div', null, array(
	'style' => 'margin: 0.5em auto; max-width: 25em;',
));
echo $this->Session->flash('auth');

echo $this->Form->create('Usuario', array(
	'url' => array(
		'controller' => 'usuarios',
		'action' => 'login',
	),
	'class' => 'cake',
));

echo $this->Form->input('login', array(
	'label' => 'Login',
	'class' => 'form-control',
));
echo $this->Form->input('senha', array(
	'label' => 'Senha', 
	'class' => 'form-control',
	'type' => 'password',
));

echo $this->Form->submit('Entrar', array(
	'div' => array(
		'class' => 'input',
		'style' => 'clear: none; text-align: right'
	),
	'class' => 'btn btn-primary',
));

echo $this->Form->end();

echo $this->Html->tag('br');
echo $this->Html->tag('br');
echo $this->Html->link("Não possui login? Registre-se &#10097;",
	[
		'controller' => 'pessoas',
		'action' => 'registrar',
	],
	[
		'class' => 'btn btn-primary btn-lg btn-block',
		'escape' => false,
	]
);
echo $this->Html->tag('/div');