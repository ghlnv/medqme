<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h1');
echo $this->Receitas->linkVoltarParaIndex();
echo ' Wizard de remédios';
echo $this->Html->tag('/h1');

echo $this->Receitas->formCadastro($passo);
echo $this->Html->tag('/div');