<?php 
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h1');
echo 'Minhas informações';
echo $this->Html->tag('/h1');

echo $this->Html->tag('hr');

if($role->isEstudante()) {
	echo $this->Pessoas->formPerfilEstudante();
}
else if($role->isSaude()) {
	echo $this->Pessoas->formPerfilSaude();
}
else {
	echo $this->Pessoas->formPerfil();
}

echo $this->Html->tag('br');
echo $this->Html->tag('br');

echo $this->Html->tag('h1');
echo 'Login e senha';
echo $this->Html->tag('/h1');

echo $this->Html->tag('hr');

echo $this->Pessoas->formEditarLoginSenha();
echo $this->Html->tag('/div');

$this->Js->buffer("loadMask()");
$this->Js->buffer("loadBirthPicker()");