<?php
if(!AuthComponent::user('id')) {
	echo $this->Pessoas->formRegistro();
}
else {
	echo $this->Html->tag('div', null, ['class' => 'container']);
	echo $this->Html->tag('h1', 'Bem vindo ao MedQMe!', [
		'style' => 'text-align: center;',
	]);
	echo $this->Html->tag('/div');
}