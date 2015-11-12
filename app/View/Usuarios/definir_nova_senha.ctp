<?php 
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h2', 'Defina sua nova senha de acesso');

echo $this->Html->tag('hr');

$url = $this->params['pass'];
echo $this->Form->create('Usuario', array(
	'url' => $url,
	'class' => 'ajax',
	'style' => 'margin: 0.5em auto 0; width: 30em;'
));
echo $this->Form->input('Usuario.id');
echo $this->Form->input('Usuario.login', array(
	'label' => 'Login',
	'class' => 'form-control',
	'readonly' => true,
	'style' => 'width: 94%;',
));
echo $this->Form->input('Usuario.nova_senha', array(
	'label'=> 'Nova senha',
	'type' => 'password',
	'size' => 20,
	'class' => 'form-control empty',
	'style' => 'width: 94%;',
));
echo $this->Form->input('Usuario.confirm', array(
	'label'=> 'Confirme a nova senha',
	'type' => 'password',
	'size' => 20,
	'class' => 'form-control empty',
	'style' => 'width: 94%;',
));  
echo $this->Form->submit('Salvar', array(
	'div' => array(
		'style' => 'margin: 0 2em; text-align: right;'
	),
	'class' => 'btn btn-primary',
));
echo $this->Form->end();
echo $this->Html->tag('/div');