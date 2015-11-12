<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h1');
echo __('Medicamentos');
echo $this->Medicamentos->linkParaCadastrar();
echo $this->Medicamentos->linkParaImportar();
echo $this->Html->tag('/h1');
echo $this->Medicamentos->formBuscaPadrao();

echo $this->Html->tag('table', null, ['class' => 'table table-striped table-hover']);
foreach($medicamentos as $medicamento) {
	echo $this->Html->tag('tr');
	echo $this->Html->tag('td');
	echo $this->Html->tag('div', null, ['class' => 'row']);
	echo $this->Html->tag('div', null, ['class' => 'col-md-10']);
	echo $this->Html->tag('b');
	echo $medicamento['Medicamento']['nome'];
	if($medicamento['Medicamento']['codigo']) {
		echo ' - ';
		echo $medicamento['Medicamento']['codigo'];
	}
	echo ' [';
	echo $medicamento['Medicamento']['codigo_ggrem'];
	echo ']';
	echo $this->Html->tag('/b');

	if($medicamento['Medicamento']['principio_ativo']) {
		echo $this->Html->tag('div', null, array('class' => 'smallText'));
		echo $this->Html->tag('b');
		echo 'Princípio ativo: ';
		echo $this->Html->tag('/b');
		echo $medicamento['Medicamento']['principio_ativo'];
		echo $this->Html->tag('/div');
	}

	if($medicamento['Medicamento']['formas_farmaceuticas_solidas']) {
		echo $this->Html->tag('div', null, array('class' => 'smallText'));
		echo $this->Html->tag('b');
		echo 'Forma farmacêutica sólida: ';
		echo $this->Html->tag('/b');
		echo $medicamento['Medicamento']['formas_farmaceuticas_solidas'];
		echo $this->Html->tag('/div');
	}

	if($medicamento['Medicamento']['formas_farmaceuticas_liquidas']) {
		echo $this->Html->tag('div', null, array('class' => 'smallText'));
		echo $this->Html->tag('b');
		echo 'Forma farmacêutica líquida: ';
		echo $this->Html->tag('/b');
		echo $medicamento['Medicamento']['formas_farmaceuticas_liquidas'];
		echo $this->Html->tag('/div');
	}

	if($medicamento['Medicamento']['formas_farmaceuticas_semisolidas']) {
		echo $this->Html->tag('div', null, array('class' => 'smallText'));
		echo $this->Html->tag('b');
		echo 'Forma farmacêutica semi-sólida: ';
		echo $this->Html->tag('/b');
		echo $medicamento['Medicamento']['formas_farmaceuticas_semisolidas'];
		echo $this->Html->tag('/div');
	}

	if($medicamento['Medicamento']['formas_farmaceuticas_gasosas']) {
		echo $this->Html->tag('div', null, array('class' => 'smallText'));
		echo $this->Html->tag('b');
		echo 'Forma farmacêutica gasosa: ';
		echo $this->Html->tag('/b');
		echo $medicamento['Medicamento']['formas_farmaceuticas_gasosas'];
		echo $this->Html->tag('/div');
	}

	if($medicamento['Medicamento']['dosagem']) {
		echo $this->Html->tag('div', null, array('class' => 'smallText'));
		echo $this->Html->tag('b');
		echo 'Dosagem: ';
		echo $this->Html->tag('/b');
		echo $medicamento['Medicamento']['dosagem'];
		echo ' ';
		echo $medicamento['Medicamento']['unidade'];
		echo $this->Html->tag('/div');
	}

	if($medicamento['Medicamento']['apresentacao']) {
		echo $this->Html->tag('div', null, array('class' => 'smallText'));
		echo $this->Html->tag('b');
		echo 'Apresentação: ';
		echo $this->Html->tag('/b');
		echo $medicamento['Medicamento']['apresentacao'];
		echo $this->Html->tag('/div');
	}

	if($medicamento['Medicamento']['classe_terapeutica']) {
		echo $this->Html->tag('div', null, array('class' => 'smallText'));
		echo $this->Html->tag('b');
		echo 'Classe terapêutica: ';
		echo $this->Html->tag('/b');
		echo $medicamento['Medicamento']['classe_terapeutica'];
		echo $this->Html->tag('/div');
	}
	echo $this->Html->tag('/div');

	echo $this->Html->tag('div', null, array(
		'class' => 'col-md-2',
		'style' => 'margin-bottom: 10px; text-align: right;'
	));
	echo $this->Html->tag('span', 'PMC 0: ', [
		'class' => 'smallText',
	]);
	echo $this->Html->tag('span', null, [
		'style' => 'font-weight: bolder; font-size: 1.1em; white-space: nowrap;'
	]);
	echo $this->Gerar->moedaReal($medicamento['Medicamento']['pmc_0']);
	echo $this->Html->tag('/span');
	echo $this->Html->tag('/div');
	
	echo $this->Html->tag('div', null, array(
		'class' => 'col-md-2',
		'style' => 'text-align: right;'
	));
	echo $this->Medicamentos->linkParaEditar($medicamento['Medicamento']);
	echo $this->Medicamentos->linkParaEditarPrecos($medicamento['Medicamento']);
	echo $this->Medicamentos->linkParaExcluir($medicamento['Medicamento']);
	echo $this->Html->tag('/div');
	echo $this->Html->tag('/div');
	echo $this->Html->tag('/td');
	echo $this->Html->tag('/tr');
}
echo $this->Html->tag('/table');
echo $this->element('paginator/rodape');
echo $this->Html->tag('/div');

$this->Js->buffer('loadDlgEditarPadrao();');
$this->Js->buffer('loadDlgCadastrarPadrao();');
$this->Js->buffer('loadDlgImportar();');
$this->Js->buffer('loadDatePicker();');
