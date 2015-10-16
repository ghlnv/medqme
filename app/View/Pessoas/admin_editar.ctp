<?php 
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('div', null, ['class' => 'row']);
echo $this->Html->tag('div', null, ['class' => 'col-md-8']);
echo $this->Html->tag('h1');
echo $this->Pessoas->linkVoltarParaPessoas();
echo ' Informações';
echo $this->Html->tag('/h1');

echo $this->Html->tag('hr');

echo $this->Pessoas->formPerfil();
echo $this->Html->tag('/div');

echo $this->Html->tag('div', null, ['class' => 'col-md-4']);
echo $this->Html->tag('h1');
echo 'Login e senha';
echo $this->Html->tag('/h1');

echo $this->Html->tag('hr');

echo $this->Pessoas->formEditarLoginSenhaAdmin();
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');
echo $this->Pessoas->linkPagina($this->request->data['Pessoa']);
echo $this->Html->tag('/div');

$this->Js->buffer("loadMask()");
$this->Js->buffer("loadBirthPicker()");