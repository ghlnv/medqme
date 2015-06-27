<?php 
echo gerarForm($this);

//$this->Js->buffer("loadDatePicker();");

function gerarForm(&$view) {
	$ret = '';
	$ret.= $view->Form->create('Medicamento', array(
		'class' => 'ajax',
	));

	$ret.= $view->Form->hidden('Medicamento.id');
	$ret.= $view->Form->input('Medicamento.nome', array(
	));
	$ret.= $view->Form->end();
	return $ret;
}