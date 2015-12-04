<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('div', null, ['class' => 'col-ib-10']);
echo $this->Html->tag('h1');
echo __('Meus Remédios');
echo $this->Html->tag('/h1');
echo $this->Html->tag('/div');
echo $this->Html->tag('div', null, [
	'class' => 'col-ib-2',
	'style' => 'vertical-align: middle; text-align: right;'
]);
echo $this->Receitas->linkParaCadastrar();
echo $this->Html->tag('/div');

echo $this->Html->tag('table', null, ['class' => 'table table-striped table-hover']);
foreach($receitas as $receita) {
	echo $this->Html->tag('tr');
	echo $this->Html->tag('td', null, ['style' => 'line-height: 30px;']);
	echo $this->Html->tag('div', null, ['class' => 'row']);
	echo $this->Html->tag('div', null, ['class' => 'col-md-9']);
	echo $this->Html->tag('b');
	echo $receita['Receita']['nome'];
	echo $this->Html->tag('/b');
	echo ' | ';
	echo $receita['Medicamento']['apresentacao_reduzida'];
	echo $this->Html->tag('div', null, ['class' => 'smallText']);
	echo $this->Gerar->brDate($receita['Receita']['inicio'], 'd/m/Y');
	echo ' à ';
	echo $this->Gerar->brDate($receita['Receita']['termino'], 'd/m/Y');
	echo ' | ';
	echo $this->Receitas->periodicidade($receita['Receita']['periodicidade']);

	if($receita['Receita']['observacoes']) {
		echo $this->Html->tag('br');
		echo 'Obs.: ';
		echo $receita['Receita']['observacoes'];
	}
	echo $this->Html->tag('/div');
	echo $this->Html->tag('/div');
	
	echo $this->Html->tag('div', null, array(
		'class' => 'col-md-3',
		'style' => 'margin-bottom: 10px; text-align: right;'
	));
	echo $this->Html->tag('span', 'Preço sugerido: ', [
		'class' => 'smallText',
	]);
	echo $this->Html->tag('span', null, [
		'style' => 'font-weight: bolder; font-size: 1.1em; white-space: nowrap;'
	]);
	echo $this->Gerar->moedaReal($receita['Medicamento']['pmc_18']);
	echo $this->Html->tag('/span');
	echo $this->Html->tag('/div');

	echo $this->Html->tag('div', null, array(
		'class' => 'col-md-3',
		'style' => 'text-align: right;'
	));
	echo $this->Receitas->linkParaEditar($receita['Receita']);
	echo $this->Receitas->linkParaExcluir($receita['Receita']);
	echo $this->Html->tag('/div');
	echo $this->Html->tag('/div');
	echo $this->Html->tag('/td');
	echo $this->Html->tag('/tr');
}
echo $this->Html->tag('/table');
echo $this->element('paginator/rodape');
echo $this->Html->tag('/div');