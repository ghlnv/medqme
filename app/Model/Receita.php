<?php
App::uses('AppModel', 'Model');

/**
 * CakePHP ReceitaModel
 * @author dudow
 */
class Receita extends AppModel {
	
	public $displayField = 'nome';
	public $order = array(
		'Receita.nome' => 'ASC',
		'Receita.inicio' => 'ASC',
		'Receita.termino' => 'ASC',
	);
	
	public $belongsTo = [
		'Medicamento',
	];

	public $validate = array(
		'pessoa_id' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Campo obrigatório',
			),
		),
		'medicamento_id' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Campo obrigatório',
			),
		),
		'nome' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Campo obrigatório',
			),
		),
		'inicio' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Campo obrigatório',
			),
		),
		'termino' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Campo obrigatório',
			),
		),
		'dosagem' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Campo obrigatório',
			),
		),
	);
	
	// #########################################################################
	// Métodos #################################################################
	public function mobileAtivos($pessoaId) {
		return $this->find('all', [
			'conditions' => [
				'Receita.pessoa_id' => $pessoaId,
				'Receita.termino >=' => date('Y-m-d'),
			],
			'contain' => false,
		]);
	}
	public function atualizar($requestData) {
		if(!empty($requestData['Receita']['inicio'])) {
			$this->beforeSaveBrDate($requestData['Receita']['inicio']);
		}
		if(!empty($requestData['Receita']['termino'])) {
			$this->beforeSaveBrDate($requestData['Receita']['termino']);
		}
		return $this->save($requestData);
	}
}
