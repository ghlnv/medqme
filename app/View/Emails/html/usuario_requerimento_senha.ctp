<?php
$primeiroNome = $this->Gerar->explodeReset($usuario['Pessoa']['nome']);
$usuarioId = $usuario['Usuario']['id'];

echo "Olá $primeiroNome, sua nova senha para acessar o MedQMe foi requerida com sucesso!";
echo $this->Html->tag('br');
echo $this->Html->tag('br');
echo 'Para cadastra-la acesse o seguinte endereço: ';
echo $this->Html->link($this->Html->url("/definirNovaSenha/$usuarioId/$token", true));

echo $this->Html->tag('br');
echo $this->Html->tag('br');
echo "Um ótimo dia!";