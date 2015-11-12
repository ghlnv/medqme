<?php
$primeiroNome = $this->Gerar->explodeReset($admin['Pessoa']['nome']);

echo "Olá $primeiroNome, um novo cadastro foi efetuado!";
echo $this->Html->tag('br');
echo $this->Html->tag('br');

echo 'O nome do novo usuário é ';
echo $this->Html->tag('b', $usuario['Pessoa']['nome']);
echo '.';
echo $this->Html->tag('br');
echo $this->Html->tag('br');

echo 'O login cadastrado é ';
echo $this->Html->tag('b', $usuario['Usuario']['login']);
echo '.';