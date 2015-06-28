<?php
echo medicamentos($this, $medicamentos);

$this->Js->buffer('loadDlgEditarPadrao();');
$this->Js->buffer('loadDlgCadastrarPadrao();');
$this->Js->buffer('loadDlgImportar();');
$this->Js->buffer('loadDatePicker();');

function medicamentos(&$view, &$medicamentos) {
	$ret = '';
	$ret.= $view->Html->tag('h1');
	$ret.= __('Medicamentos');
	$ret.= linkParaCadastrarMedicamento($view);
	$ret.= linkParaImportar($view);
	$ret.= $view->Html->tag('/h1');
	$ret.= $view->Html->tag('div', '', array('class' => 'line'));
	$ret.= busca($view);

	$ret.= $view->Html->tag('table');
	foreach($medicamentos as $medicamento) {
		$ret.= $view->Html->tag('tr');
		$ret.= $view->Html->tag('td', null, array('style' => 'width: 90%;'));
		$ret.= $view->Html->tag('div', null, array(
			'style' => ''
		));
		$ret.= $view->Html->tag('b');
		if($medicamento['Medicamento']['codigo']) {
			$ret.= $medicamento['Medicamento']['codigo'];
			$ret.= ' - ';
		}
		$ret.= $medicamento['Medicamento']['nome'];
		$ret.= ' [';
		$ret.= $medicamento['Medicamento']['codigo_ggrem'];
		$ret.= ']';
		$ret.= $view->Html->tag('/b');
		
		if($medicamento['Medicamento']['principio_ativo']) {
			$ret.= $view->Html->tag('div', null, array('class' => 'smallText'));
			$ret.= $view->Html->tag('b');
			$ret.= 'Princípio ativo: ';
			$ret.= $view->Html->tag('/b');
			$ret.= $medicamento['Medicamento']['principio_ativo'];
			$ret.= $view->Html->tag('/div');
			$ret.= $view->Html->tag('/div');
		}
		
		if($medicamento['Medicamento']['laboratorio']) {
			$ret.= $view->Html->tag('div', null, array('class' => 'smallText'));
			$ret.= $view->Html->tag('b');
			$ret.= 'Laboratório: ';
			$ret.= $view->Html->tag('/b');
			$ret.= $medicamento['Medicamento']['laboratorio'];
			$ret.= $view->Html->tag('/div');
			$ret.= $view->Html->tag('/div');
		}
		
		if($medicamento['Medicamento']['apresentacao']) {
			$ret.= $view->Html->tag('div', null, array('class' => 'smallText'));
			$ret.= $view->Html->tag('b');
			$ret.= 'Apresentação: ';
			$ret.= $view->Html->tag('/b');
			$ret.= $medicamento['Medicamento']['apresentacao'];
			$ret.= $view->Html->tag('/div');
			$ret.= $view->Html->tag('/div');
		}
		
		if($medicamento['Medicamento']['classe_terapeutica']) {
			$ret.= $view->Html->tag('div', null, array('class' => 'smallText'));
			$ret.= $view->Html->tag('b');
			$ret.= 'Classe terapêutica: ';
			$ret.= $view->Html->tag('/b');
			$ret.= $medicamento['Medicamento']['classe_terapeutica'];
			$ret.= $view->Html->tag('/div');
			$ret.= $view->Html->tag('/div');
		}
		$ret.= $view->Html->tag('/td');
		
		$ret.= $view->Html->tag('td', null, array('style' => 'line-height: 32px; text-align: center;'));
		$ret.= linkParaEditarMedicamento($view, $medicamento['Medicamento']);
		$ret.= linkParaEditarPrecos($view, $medicamento['Medicamento']);
		$ret.= linkParaExcluirMedicamento($view, $medicamento['Medicamento']);
		$ret.= $view->Html->tag('/td');
		$ret.= $view->Html->tag('/tr');
	}
	$ret.= $view->Html->tag('/table');
	$ret.= $view->element('paginator/navigation');
	return $ret;

}
function busca(&$view) {
	$ret = '';
	$ret.= $view->Form->create('Filtro', array(
		'url' => array_merge(
			array(
				'controller' => 'medicamentos',
			)
		),
		'class' => 'ajax',
		'style' => 'margin: 0 0 0 1em;',
	));

	$ret.= $view->Form->submit('Buscar', array(
		'div' => array('style' => 'width: auto; vertical-align: middle;'),
	));
	$ret.= $view->Form->input('Filtro.keyword', array(
		'div' => array('style' => 'width: auto; vertical-align: middle;'),
		'label' => false,
		'placeholder' => 'Palavras-chaves',
	));
	$ret.= $view->Form->end();
	return $ret;
}
function linkParaCadastrarMedicamento(&$view) {
	return $view->Html->link($view->Html->image('icons/toggle_add.png').' novo',
		array(
			'admin' => true,
			'controller' => 'medicamentos',
			'action' => 'cadastrar',
		),
		array(
			'class' => 'dlgCadastrarPadrao botao',
			'title' => 'Cadastrar medicamento',
			'style' => 'margin-left: 1em;',
			'escape' => false
		)
	);
}
function linkParaImportar(&$view) {
	return $view->Html->link($view->Html->image('icons/upload-16.png').' importar',
		array(
			'admin' => true,
			'controller' => 'medicamentos',
			'action' => 'importar',
		),
		array(
			'class' => 'dlgImportar botao',
			'title' => 'Importar medicamentos',
			'style' => 'margin-left: 1em;',
			'escape' => false
		)
	);
}
function linkParaExcluirMedicamento(&$view, &$medicamento) {
	return $view->Html->link($view->Html->image('icons/delete-16.png'),
		array(
			'admin' => true,
			'controller' => 'medicamentos',
			'action' => 'excluir',
			$medicamento['id'],
		),
		array(
			'title' => 'Excluir medicamento',
			'style' => 'margin: 0 0.5em;',
			'confirm' => 'Tem certeza que deseja excluir este medicamento?',
			'escape' => false
		)
	);
}
function linkParaEditarMedicamento(&$view, &$medicamento) {
	return $view->Html->link($view->Html->image('icons/edit-16.png'),
		array(
			'admin' => true,
			'controller' => 'medicamentos',
			'action' => 'editar',
			$medicamento['id'],
		),
		array(
			'class' => 'dlgEditarPadrao',
			'title' => 'Editar medicamento',
			'style' => 'margin: 0 0.5em;',
			'escape' => false
		)
	);
}
function linkParaEditarPrecos(&$view, &$medicamento) {
	return $view->Html->link($view->Html->image('icons/edit-blue-16.png'),
		array(
			'admin' => true,
			'controller' => 'medicamentos',
			'action' => 'editarPrecos',
			$medicamento['id'],
		),
		array(
			'class' => 'dlgEditarPadrao',
			'title' => 'Editar preços do medicamento',
			'style' => 'margin: 0 0.5em;',
			'escape' => false
		)
	);
}