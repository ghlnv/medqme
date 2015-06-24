<?php 
echo $this->Html->tag('h1');
echo 'Minhas informações';
echo $this->Html->tag('/h1');

echo $this->Html->tag('hr', null, array(
	'style' => 'margin-top: 10px; margin-bottom: 0;',
));

echo $this->Form->create('Pessoa', array(
	'url' => array(
		'controller' => 'pessoas',
		'action' => 'meuPerfil',
	),
	'class' => 'cakeForm centralizarComTamanhoMaximo',
	'style' => 'padding: 1em 2em;',
));

echo $this->Form->input('Pessoa.id', array(
	'style' => ''
));
echo $this->Form->input('Pessoa.nome', array(
	'div' => array(
		'style' => 'float: left; margin-right: 1em;',
	),
	'style' => 'width: 20em;'
));
echo $this->Form->input('Pessoa.cpf', array(
	'div' => array(
		'style' => 'float: left; margin-right: 1em;',
	),
	'label' => 'CPF',
	'style' => 'width: 9em;',
	'class' => 'mask',
	'alt' => 'cpf',
));
echo $this->Form->input('Pessoa.email', array(
	'div' => array(
		'style' => 'clear: left; float: left; margin-right: 1em;',
	),
	'label' => 'E-mail',
	'style' => 'width: 300px;'
));
echo $this->Form->input('Pessoa.telefone', array(
	'div' => array(
		'style' => 'float: left; margin-right: 1em;',
	),
	'class' => 'mask telefone',
	'alt' => 'phone',
));
echo $this->Form->input('Pessoa.celular', array(
	'div' => array(
		'style' => 'float: left; margin-right: 1em;',
	),
	'class' => 'mask telefone',
	'alt' => 'phone',
));

echo $this->Form->input('Pessoa.logradouro', array(
	'div' => array(
		'style' => 'clear: left; float: left; margin-right: 1em;',
	),
	'style' => 'width: 14em;',
));
echo $this->Form->input('Pessoa.numero', array(
	'div' => array(
		'style' => 'float: left; margin-right: 1em;',
	),
	'label' => 'Número',
	'style' => 'width: 4em;',
));
echo $this->Form->input('Pessoa.complemento', array(
	'div' => array(
		'style' => 'float: left; margin-right: 1em;',
	),
	'style' => 'width: 8em;',
));
echo $this->Form->input('Pessoa.bairro', array(
	'div' => array(
		'style' => 'float: left; margin-right: 1em;',
	),
	'style' => 'width: 12em;',
));

echo $this->Form->input('Pessoa.cidade', array(
	'div' => array(
		'style' => 'clear: left; float: left; margin-right: 20px;'
	),
	'style' => 'width: 12em;',
));
echo $this->Form->input('Pessoa.estado', array(
	'div' => array(
		'style' => 'float: left; margin-right: 20px;'
	),
	'style' => 'width: 2em; text-align: center;'
));

echo $this->Form->input('Pessoa.cep', array(
	'div' => array(
		'style' => 'float: left; margin-right: 1em;',
	),
	'style' => 'width: 6em; text-align: center;'
));

echo $this->Form->submit('Salvar', array(
	'div' => array(
		'style' => 'clear: both;',
	),
));
echo $this->Form->end();

echo $this->Html->tag('h1');
echo 'Login e senha';
echo $this->Html->tag('/h1');

echo $this->Html->tag('hr', null, array(
	'style' => 'margin-top: 10px; margin-bottom: 0;',
));

echo $this->Form->create('Usuario', array(
	'url' => array(
		'controller' => 'pessoas',
	),
	'class' => 'cakeForm centralizarComTamanhoMaximo',
	'style' => 'padding: 1em 2em;',
));
echo $this->Form->input('id');
echo $this->Form->hidden('Usuario.pessoa_id');

echo $this->Html->tag('div', null, array('style' => 'float: left; margin: 0 1em 0 0; padding: 0;'));
echo $this->Form->input('Usuario.login', array(
	'label' => 'Login',
	'style' => 'width: 200px;',
	'readonly' => true,
));
echo $this->Form->input('senha_atual', array(
	'label'=> 'Senha atual',
	'type' => 'password',
	'size' => 20,
	'class' => 'empty',
	'style' => 'width: 200px;',
));
echo $this->Html->tag('/div');

echo $this->Html->tag('div', null, array('style' => 'float: left; margin: 0; padding: 0;'));
echo $this->Form->input('nova_senha', array(
	'label'=> 'Nova senha',
	'type' => 'password',
	'size' => 20,
	'class' => 'empty',
	'style' => 'width: 200px;',
));
echo $this->Form->input('confirm', array(
	'label'=> 'Confirme a nova senha',
	'type' => 'password',
	'size' => 20,
	'class' => 'empty',
	'style' => 'width: 200px;',
));  
echo $this->Html->tag('/div');

echo $this->Form->submit('Salvar', array(
	'div' => array(
		'style' => 'clear: both; float: left; margin-top: 0;',
	),
));
echo $this->Html->tag('div', '', array('class' => 'clear'));
echo $this->Form->end();

$this->Js->buffer("loadMeioMask()");