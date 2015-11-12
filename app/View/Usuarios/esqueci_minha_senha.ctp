<?php 
echo $this->Form->create('Usuario', array(
	'class' => 'ajax',
	'style' => ''
));
echo $this->Form->input('Usuario.login', array(
	'style' => 'width: 100%;',
	'class' => 'form-control',
));
echo $this->Form->end();

$this->Js->buffer("$('#UsuarioEsqueciMinhaSenhaForm #UsuarioLogin').focus();");