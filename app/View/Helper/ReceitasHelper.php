<?php
class ReceitasHelper extends AppHelper { 
    var $helpers = array('Html', 'Js', 'Form', 'Text', 'Number', 'Gerar'); 
	
	public $periodicidades;
	
	public function __construct($View) {
		parent::__construct($View);
		$this->periodicidades = Configure::read('Periodicidade.tipos');
	}

	// #########################################################################
	// Métodos #################################################################
	public function periodicidade($periodicidade) {
		if(!isset($this->periodicidades[$periodicidade])) {
			return false;
		}
		return $this->periodicidades[$periodicidade];
	}
	public function linkVoltarParaIndex() {
		return $this->Html->link("&#10096;",
			array(
				'admin' => false,
				'controller' => 'receitas',
				'action' => 'index',
			),
			array(
				'class' => '',
				'title' => 'Voltar para receitas',
				'style' => '',
				'escape' => false
			)
		);
	}
	public function linkParaCadastrar() {
		return $this->Html->link("nova receita &#10097;",
			array(
				'admin' => false,
				'controller' => 'receitas',
				'action' => 'cadastrar',
			),
			array(
				'class' => 'dlgCadastrarPadrao btn btn-primary',
				'title' => 'Cadastrar nova receita',
				'style' => '',
				'escape' => false
			)
		);
	}
	public function linkParaExcluir(&$receita) {
		return $this->Html->link($this->Html->image('icons/remove-32.png'),
			array(
				'admin' => false,
				'controller' => 'receitas',
				'action' => 'excluir',
				$receita['id'],
			),
			array(
				'title' => 'Excluir receita',
				'style' => 'margin: 0 0.5em;',
				'confirm' => 'Tem certeza que deseja excluir este receita?',
				'escape' => false
			)
		);
	}
	public function linkParaEditar(&$receita) {
		return $this->Html->link($this->Html->image('icons/edit-32.png'),
			array(
				'admin' => false,
				'controller' => 'receitas',
				'action' => 'wizard',
				$receita['id'],
			),
			array(
				'class' => 'dlgEditarPadrao',
				'title' => 'Editar receita',
				'style' => 'margin: 0 0.5em;',
				'escape' => false
			)
		);
	}
	public function formBuscaPadrao() {
		$ret = '';
		$ret.= $this->Form->create('Filtro', array(
			'url' => [
				'controller' => $this->request->params['controller'],
			],
			'class' => 'form-inline',
			'style' => 'margin-bottom: 10px; padding: 10px;',
		));
		$ret.= $this->Form->input('Filtro.keywords', array(
			'div' => [
				'class' => 'form-group col-md-4',
				'style' => 'display: inline-block; float: none; padding: 0 5px 0 0; min-width: 200px;',
			],
			'label' => false,
			'placeholder' => 'Palavras-chaves...',
			'title' => 'Palavras-chaves...',
			'class' => 'form-control',
			'style' => 'width: 100%',
		));
		$ret.= $this->Form->submit('Buscar', array(
			'div' => [
				'class' => 'form-group col-md-2',
				'style' => 'display: inline-block; float: none; padding: 0;',
			],
			'class' => 'btn btn-default',
		));
		$ret.= $this->Form->end();
		return $ret;
	}
	public function formCadastro($passo) {
		$this->Js->buffer("loadDatePicker();");
		$this->Js->buffer("loadFormSubmitLink('.submitLink');");
		
		$ret = '';
		$ret.= $this->Form->create('Receita', array(
			'url' => [
				'controller' => 'receitas',
				'action' => 'wizard',
				$this->request->data['Receita']['id'],
				$passo+1,
			],
			'class' => 'ajax',
		));
		$ret.= $this->Form->hidden('Receita.id');
		switch ($passo) {
			case 1 :
				$inputId = String::uuid();
				$urlAutocomplete = $this->Html->url(array(
					'admin' => false,
					'controller' => 'medicamentos',
					'action' => 'autocompleteNome',
				), true);
				$this->Js->buffer("loadAutoComplete('#$inputId', '$urlAutocomplete');");
				$ret.= $this->Form->input('Receita.nome', array(
					'id' => $inputId,
					'label' => 'Nome do medicamento',
					'class' => 'form-control',
				));
			break;
			case 2 :
				$ret.= $this->Form->input('Receita.dosagem', array(
					'label' => 'Dosagem',
					'class' => 'form-control',
					'options' => $this->_View->viewVars['dosagens'],
				));
			break;
			case 3 :
				$ret.= $this->Form->input('Receita.medicamento_id', array(
					'label' => 'Medicamento',
					'class' => 'form-control',
				));
			break;
			case 4 :
				$ret.= $this->Form->input('Receita.inicio', array(
					'div' => ['style' => 'display: inline-block; width: auto;'],
					'type' => 'text',
					'class' => 'date form-control',
					'value' => $this->Gerar->brDate($this->request->data['Receita']['inicio']),
				));
				$ret.= $this->Form->input('Receita.termino', array(
					'div' => ['style' => 'display: inline-block; width: auto;'],
					'type' => 'text',
					'class' => 'date form-control',
					'value' => $this->Gerar->brDate($this->request->data['Receita']['termino']),
				));
				$ret.= $this->Form->input('Receita.periodicidade', array(
					'div' => ['style' => 'display: inline-block; width: auto;'],
					'label' => 'Periodicidade',
					'class' => 'form-control',
					'options' => Configure::read('Periodicidade.tipos'),
				));
				$ret.= $this->Form->input('Receita.observacoes', array(
					'label' => 'Observações',
					'class' => 'form-control',
					'rows' => 2,
				));
			break;
		}
		
		$ret.= $this->Html->tag('div', null, ['style' => 'text-align: center;']);
		if($passo > 1) {
			$ret.= $this->Form->submit("&#10096; Anterior", [
				'div' => ['style' => 'display: inline-block;'],
				'href' => $this->Html->url([
					'action' => 'wizard',
					$this->request->data['Receita']['id'],
					$passo-1,
				]),
				'class' => 'btn btn-warning submitLink',
				'escape' => false,
			]);
		}
		
		if($passo != 4) {
			$ret.= $this->Form->submit("Próximo &#10097;", [
				'div' => ['style' => 'display: inline-block;'],
				'class' => 'btn btn-primary',
				'escape' => false,
			]);
		}
		else {
			$ret.= $this->Form->submit("Finalizar &#10097;", [
				'div' => ['style' => 'display: inline-block;'],
				'href' => $this->Html->url([
					'action' => 'salvar',
				]),
				'class' => 'btn btn-primary submitLink',
				'escape' => false,
			]);
		}
		$ret.= $this->Html->tag('/div');
		$ret.= $this->Form->end();
		return $ret;
	}
	
	// #########################################################################
	// Métodos privados ########################################################
}