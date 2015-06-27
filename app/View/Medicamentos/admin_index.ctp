<?php
echo gerarMedicamentos($this, $medicamentos);

$this->Js->buffer('loadDlgEditarPadrao();');
$this->Js->buffer('loadDlgCadastrarPadrao();');
$this->Js->buffer('loadDatePicker();');

function gerarMedicamentos(&$view, &$medicamentos) {
	$ret = '';
	$ret.= $view->Html->tag('h1');
	$ret.= __('Medicamentos');
	$ret.= gerarLinkParaCadastrarMedicamento($view);
	$ret.= $view->Html->tag('/h1');
//	$ret.= gerarBusca($view);
	$ret.= $view->Html->tag('div', '', array('class' => 'line'));

	$ret.= $view->Html->tag('table');
	foreach($medicamentos as $medicamento) {
		$ret.= $view->Html->tag('tr');
		$ret.= $view->Html->tag('td', null, array('style' => 'width: 50%;'));
		$ret.= $view->Html->tag('div', null, array(
			'style' => ''
		));
		$ret.= $view->Html->tag('b');
		$ret.= $view->Time->format('d/m/Y', $medicamento['Medicamento']['created']);
		$ret.= ' - ';
		$ret.= $medicamento['Medicamento']['nome'];
		$ret.= $view->Html->tag('/b');
		
//		$ret.= $view->Html->tag('div', null, array('style' => 'font-size: 0.9em;'));
//		$ret.= ' - ';
//		$ret.= $medicamento['Medicamento']['descricao'];
//		$ret.= $view->Html->tag('/div');
		$ret.= $view->Html->tag('/div');
		$ret.= $view->Html->tag('/td');
		
		$ret.= $view->Html->tag('td');
		$ret.= $view->Html->tag('/td');
		
		$ret.= $view->Html->tag('td', null, array('style' => 'line-height: 32px; text-align: center;'));
		$ret.= gerarLinkParaEditarMedicamento($view, $medicamento['Medicamento']);
		$ret.= gerarLinkParaExcluirMedicamento($view, $medicamento['Medicamento']);
		$ret.= $view->Html->tag('/td');
		$ret.= $view->Html->tag('/tr');
	}
	$ret.= $view->Html->tag('/table');
	$ret.= $view->element('paginator/navigation');
	return $ret;

}
function gerarBusca(&$view) {
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
		'div' => array('style' => 'clear: none; float: left; margin-bottom: 0; margin-right: 0.5em;'),
	));
	$ret.= $view->Form->input('Filtro.pessoa_id', array(
		'div' => array('style' => 'float: left; margin-bottom: 0;'),
		'label' => 'Profissionais de Saúde',
		'empty' => '-- Todos --',
		'style' => 'width: 11em;',
	));
	$ret.= $view->Form->input('Filtro.data_minima', array(
		'div' => array('style' => 'float: left; margin-bottom: 0;'),
		'label' => 'Data mínima',
		'type' => 'text',
		'class' => 'date',
	));
	$ret.= $view->Form->input('Filtro.data_maxima', array(
		'div' => array('style' => 'float: left; margin-bottom: 0;'),
		'label' => 'Data máxima',
		'type' => 'text',
		'class' => 'date',
	));
	$ret.= $view->Form->end();
	return $ret;
}
function gerarLinkParaCadastrarMedicamento(&$view) {
	return $view->Html->link($view->Html->image('icons/toggle_add.png'),
		array(
			'admin' => true,
			'controller' => 'medicamentos',
			'action' => 'cadastrar',
		),
		array(
			'class' => 'dlgCadastrarPadrao',
			'title' => 'Cadastrar medicamento',
			'style' => 'margin-left: 1em;',
			'escape' => false
		)
	);
}
function gerarLinkParaExcluirMedicamento(&$view, &$medicamento) {
	return $view->Html->link($view->Html->image('icons/delete-16.png'),
		array(
			'admin' => true,
			'controller' => 'medicamentos',
			'action' => 'excluir',
			$medicamento['id'],
		),
		array(
			'title' => 'Excluir documento sugerido',
			'style' => 'margin: 0 0.5em;',
			'confirm' => 'Tem certeza que deseja excluir este medicamento?',
			'escape' => false
		)
	);
}
function gerarLinkParaEditarMedicamento(&$view, &$medicamento) {
	return $view->Html->link($view->Html->image('icons/edit-16.png'),
		array(
			'admin' => true,
			'controller' => 'medicamentos',
			'action' => 'editar',
			$medicamento['id'],
		),
		array(
			'class' => 'dlgEditarPadrao',
			'title' => 'Editar documento sugerido',
			'style' => 'margin: 0 0.5em;',
			'escape' => false
		)
	);
}