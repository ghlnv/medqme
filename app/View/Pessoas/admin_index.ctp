<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h1');
echo __('Pessoas');
echo $this->Html->tag('/h1');
echo $this->Pessoas->formBuscaPadrao();

echo $this->Html->tag('table', null, ['class' => 'table table-striped table-hover']);
foreach($pessoas as $pessoa) {
	echo $this->Html->tag('tr');
	echo $this->Html->tag('td');
	echo $this->Html->tag('div', null, ['class' => 'row']);
	echo $this->Html->tag('div', null, [
		'class' => 'col-md-6',
	]);
	echo $this->Html->tag('b');
	echo $pessoa['Pessoa']['nome'];
	echo $this->Html->tag('/b');
	
	echo $this->Html->tag('div', null, [
		'class' => 'smallText',
	]);
	echo $pessoa['Usuario']['tipo'];
	echo $this->Html->tag('/div');
	echo $this->Html->tag('/div');
	
	echo $this->Html->tag('div', null, [
		'class' => 'col-md-4',
	]);
	if('Estudante' == $pessoa['Usuario']['tipo']) {
		echo $this->Pessoas->dadosEstudante($pessoa);
	}
	else if('Profissional de Saúde' == $pessoa['Usuario']['tipo']) {
		echo $this->Pessoas->dadosSaude($pessoa);
	}
	echo $this->Html->tag('/div');
	
	echo $this->Html->tag('div', null, [
		'class' => 'col-md-2',
		'style' => 'text-align: right;',
	]);
	echo $this->Pessoas->linkParaEditar($pessoa['Pessoa']);
	echo $this->Pessoas->linkParaExcluir($pessoa['Pessoa']);
	echo $this->Html->tag('/div');
	echo $this->Html->tag('/td');
	echo $this->Html->tag('/tr');
}
echo $this->Html->tag('/table');
echo $this->element('paginator/navigation');
echo $this->Html->tag('/div');