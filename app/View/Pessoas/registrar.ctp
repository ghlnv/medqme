<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h2', 'Registre-se!');
echo $this->Html->tag('hr');
echo $this->Html->tag('div', null, ['class' => 'col-md-6 col-md-offset-3']);
echo $this->Pessoas->formRegistro();
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');
