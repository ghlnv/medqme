<?php
$primeiroNome = $this->Gerar->explodeReset($usuario['Pessoa']['nome']);
echo "Olá $primeiroNome, sua nova senha para acessar o MedQMe foi cadastrada com sucesso!";
echo $this->Html->tag('br');
echo $this->Html->tag('br');
echo 'Seu login para acesso é ';
echo $this->Html->tag('b', $usuario['Usuario']['login']);
echo ' e sua nova senha é ';
echo $this->Html->tag('b', $usuario['Usuario']['nova_senha']);
echo '.';

echo $this->Html->tag('br');
echo $this->Html->tag('br');
echo "Um ótimo dia!";