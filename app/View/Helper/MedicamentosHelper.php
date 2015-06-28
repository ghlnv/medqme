<?php
class MedicamentosHelper extends AppHelper { 
    var $helpers = array('Html', 'Js', 'Form', 'Text', 'Gerar'); 

	// #########################################################################
	// Métodos #################################################################
	public function formImport() {
		$ret = '';
		$ret.= $this->Form->create('Medicamento', array(
			'class' => 'ajax',
		));
		$ret.= $this->Form->hidden('Medicamento.id');
		$ret.= $this->Form->input('Medicamento.parseable', array(
			'label' => 'Colagem do Excel',
			'style' => 'font-size: 0.8em;',
			'rows' => 10,
		));
		$ret.= $this->Form->end();
		return $ret;
	}
	public function form() {
		$ret = '';
		$ret.= $this->Form->create('Medicamento', array(
			'class' => 'ajax',
		));
		$ret.= $this->Form->hidden('Medicamento.id');
		$ret.= $this->Form->input('Medicamento.codigo', array(
			'div' => array('style' => 'width: 30%;'),
			'label' => 'Código',
		));
		$ret.= $this->Form->input('Medicamento.nome', array(
			'div' => array('style' => 'width: 70%;'),
		));
		$ret.= $this->Form->input('Medicamento.principio_ativo', array(
			'label' => 'Princípio Ativo',
		));
		$ret.= $this->Form->input('Medicamento.laboratorio', array(
			'label' => 'Laboratório',
		));
		$ret.= $this->Form->input('Medicamento.codigo_ggrem', array(
			'div' => array('style' => 'width: 50%;'),
			'label' => 'Código GGREM',
		));
		$ret.= $this->Form->input('Medicamento.ean', array(
			'div' => array('style' => 'width: 50%;'),
			'label' => 'EAN',
		));
		$ret.= $this->Form->input('Medicamento.apresentacao', array(
			'rows' => 3,
			'label' => 'Apresentação',
		));
		$ret.= $this->Form->input('Medicamento.classe_terapeutica', array(
			'label' => 'Classe Terapêutica',
		));
		$ret.= $this->Form->input('Medicamento.restricao_hospitalar', array(
			'label' => 'Restrição Hospitalar',
		));
		$ret.= $this->Form->input('Medicamento.apresentacao_reduzida', array(
			'label' => 'Apresentação reduzida',
			'rows' => 2,
		));
		$ret.= $this->Form->input('Medicamento.vias_de_administracao', array(
			'label' => 'Vias de administração',
		));
		$ret.= $this->Form->input('Medicamento.acessorios', array(
			'label' => 'Acessórios',
		));
		$ret.= $this->Form->end();
		return $ret;
	}
}