<?php
class MedicamentosHelper extends AppHelper { 
    var $helpers = array('Html', 'Js', 'Form', 'Text', 'Number'); 

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
		$medicamentoNomeId = String::uuid();
		$urlAutocomplete = $this->Html->url(array(
			'controller' => 'medicamentos',
			'action' => 'autocompleteNome',
		), true);
		$this->Js->buffer("loadAutoComplete('#$medicamentoNomeId', '$urlAutocomplete');");
		
		$principioAtivoId = String::uuid();
		$urlAutocomplete = $this->Html->url(array(
			'controller' => 'medicamentos',
			'action' => 'autocompletePrincipioAtivo',
		), true);
		$this->Js->buffer("loadAutoComplete('#$principioAtivoId', '$urlAutocomplete');");
		
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
			'id' => $medicamentoNomeId,
		));
		$ret.= $this->Form->input('Medicamento.principio_ativo', array(
			'label' => 'Princípio Ativo',
			'id' => $principioAtivoId,
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
			'div' => array('style' => 'width: 60%'),
			'label' => 'Restrição Hospitalar',
		));
		$ret.= $this->Form->input('Medicamento.cap', array(
			'div' => array('style' => 'width: 40%'),
			'label' => 'CAP',
		));
		$ret.= $this->Form->input('Medicamento.confaz_87', array(
			'label' => 'CONFAZ 87',
		));
		$ret.= $this->Form->input('Medicamento.analise_recursal', array(
			'label' => 'Análise recursal',
		));
		$ret.= $this->Form->input('Medicamento.farmacia_popular', array(
			'label' => 'Farmácia popular',
		));
		$ret.= $this->Form->input('Medicamento.apresentacao_reduzida', array(
			'label' => 'Apresentação reduzida',
			'rows' => 2,
		));
		$ret.= $this->Form->input('Medicamento.formas_farmaceuticas_solidas', array(
			'label' => 'Formas Farmacêuticas Sólidas',
		));
		$ret.= $this->Form->input('Medicamento.formas_farmaceuticas_liquidas', array(
			'label' => 'Formas Farmacêuticas Líquidas',
		));
		$ret.= $this->Form->input('Medicamento.formas_farmaceuticas_semisolidas', array(
			'label' => 'Formas Farmacêuticas Semi-Sólidas',
		));
		$ret.= $this->Form->input('Medicamento.formas_farmaceuticas_gasosas', array(
			'label' => 'Formas Farmacêuticas Gasosas',
		));
		$ret.= $this->Form->input('Medicamento.vias_de_administracao', array(
			'label' => 'Vias de administração',
		));
		$ret.= $this->Form->input('Medicamento.embalagens_primarias', array(
			'label' => 'Embalagens Primárias',
		));
		$ret.= $this->Form->input('Medicamento.embalagens_secundarias', array(
			'label' => 'Embalagens Secundárias',
		));
		$ret.= $this->Form->input('Medicamento.acessorios', array(
			'label' => 'Acessórios',
		));
		$ret.= $this->Form->end();
		return $ret;
	}
	public function formPrecos() {
		$medicamentoNomeId = String::uuid();
		$urlAutocomplete = $this->Html->url(array(
			'controller' => 'medicamentos',
			'action' => 'autocompleteNome',
		), true);
		$this->Js->buffer("loadAutoComplete('#$medicamentoNomeId', '$urlAutocomplete');");
		$this->Js->buffer("loadMask();");
		
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
			'id' => $medicamentoNomeId,
		));
		$ret.= $this->Html->tag('div', 'Em reais (R$) :', array(
			'style' => 'width: 100%;',
		));
		$ret.= $this->Form->input('Medicamento.pf_0', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PF 0%',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Medicamento']['pf_0']),
		));
		$ret.= $this->Form->input('Medicamento.pf_12', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PF 12%',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Medicamento']['pf_12']),
		));
		$ret.= $this->Form->input('Medicamento.pf_17', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PF 17%',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Medicamento']['pf_17']),
		));
		$ret.= $this->Form->input('Medicamento.pf_18', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PF 18%',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Medicamento']['pf_18']),
		));
		$ret.= $this->Form->input('Medicamento.pf_19', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PF 19%',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Medicamento']['pf_19']),
		));
		$ret.= $this->Form->input('Medicamento.pf_17_zfm', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PF 17% ZFM',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Medicamento']['pf_17_zfm']),
		));
		$ret.= $this->Form->input('Medicamento.pmc_0', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PMC 0%',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Medicamento']['pmc_0']),
		));
		$ret.= $this->Form->input('Medicamento.pmc_12', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PMC 12%',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Medicamento']['pmc_12']),
		));
		$ret.= $this->Form->input('Medicamento.pmc_17', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PMC 17%',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Medicamento']['pmc_17']),
		));
		$ret.= $this->Form->input('Medicamento.pmc_18', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PMC 18%',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Medicamento']['pmc_18']),
		));
		$ret.= $this->Form->input('Medicamento.pmc_19', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PMC 19%',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Medicamento']['pmc_19']),
		));
		$ret.= $this->Form->input('Medicamento.pmc_17_zfm', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PMC 17% ZFM',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Medicamento']['pmc_17_zfm']),
		));
		$ret.= $this->Form->end();
		return $ret;
	}
	
	// #########################################################################
	// Métodos privados ########################################################
	private function formatPreco($preco) {
		return $this->Number->format($preco, array(
			'places' => 2,
			'before' => '',
			'decimals' => ',',
			'thousands' => '.',
		));
	}
}