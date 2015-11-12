<?php 
echo $this->Html->tag('div', null, array(
	'style' => 'margin: 0.5em auto; max-width: 25em;',
));
echo $this->Session->flash('auth');

echo $this->Pessoas->formLogin();

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