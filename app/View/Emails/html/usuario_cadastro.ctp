<?php
$primeiroNome = $this->Gerar->explodeReset($usuario['Pessoa']['nome']);
echo "Olá $primeiroNome, seu cadastro foi recebido com sucesso!";
echo $this->Html->tag('br');
echo $this->Html->tag('br');
echo 'Para acessar o MedQMe utilize...';
echo $this->Html->tag('br');
echo $this->Html->tag('br');
echo 'login: ';
echo $this->Html->tag('b', $usuario['Usuario']['login']);
echo $this->Html->tag('br');
echo ' senha: ';
echo $this->Html->tag('b', $usuario['Usuario']['nova_senha']);
echo $this->Html->tag('br');
echo $this->Html->tag('br');
echo $this->Html->link('Clique aqui para ir para a página inicial...', 
	$this->Html->url('/', true),
	[
		'escape' => false,
	]
);