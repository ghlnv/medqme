<?php
class Medicamento extends AppModel {

	public $displayField = 'nome';
	public $order = array(
		'Medicamento.codigo' => 'ASC',
		'Medicamento.nome' => 'ASC',
	);

	public $validate = array(
		'nome' => array(
			'notEmpty' => array(
				'rule' => 'notempty',
				'message' => 'Campo obrigatório',
			),
		),
		'principio_ativo' => array(
			'notEmpty' => array(
				'rule' => 'notempty',
				'message' => 'Campo obrigatório',
			),
		),
	);
	
	// #########################################################################
	// Métodos #################################################################
	public function principiosAtivosUnicos($keyword = null) {
		$options = array(
			'fields' => array('DISTINCT(Medicamento.principio_ativo) as principio_ativo'),
			'conditions' => array(),
			'contain' => false,
			'limit' => 10,
		);
		if($keyword) {
			$options['conditions']['Medicamento.principio_ativo LIKE'] = "%$keyword%";
		}
		$data = $this->find('all', $options);
		return Set::extract('/Medicamento/principio_ativo', $data);
	}
	public function nomesUnicos($keyword = null) {
		$options = array(
			'fields' => array('DISTINCT(Medicamento.nome) as nome'),
			'conditions' => array(),
			'contain' => false,
			'limit' => 10,
		);
		if($keyword) {
			$options['conditions']['Medicamento.nome LIKE'] = "%$keyword%";
		}
		$data = $this->find('all', $options);
		return Set::extract('/Medicamento/nome', $data);
	}
	public function importar($data) {
		$medicamentos = explode("\n", rtrim($data['Medicamento']['parseable']));
		foreach($medicamentos as $medicamento) {
			$medicamento = explode("\t", rtrim($medicamento));
			$medicamento = array(
				'id' => $this->field('id', array('codigo_ggrem' => $this->parserItem($medicamento, 4))),
				'codigo' => $this->parserItem($medicamento, 0),
				'principio_ativo' => $this->parserItem($medicamento, 1),
				'cnpj' => $this->parserItem($medicamento, 2),
				'laboratorio' => $this->parserItem($medicamento, 3),
				'codigo_ggrem' => $this->parserItem($medicamento, 4),
				'ean' => $this->parserItem($medicamento, 5),
				'nome' => $this->parserItem($medicamento, 6),
				'apresentacao' => $this->parserItem($medicamento, 7),
				'classe_terapeutica' => $this->parserItem($medicamento, 8),
				'pf_0' => $this->parserItem($medicamento, 9),
				'pf_12' => $this->fixBrNumber($this->parserItem($medicamento, 10)),
				'pf_17' => $this->fixBrNumber($this->parserItem($medicamento, 11)),
				'pf_18' => $this->fixBrNumber($this->parserItem($medicamento, 12)),
				'pf_19' => $this->fixBrNumber($this->parserItem($medicamento, 13)),
				'pf_17_zfm' => $this->fixBrNumber($this->parserItem($medicamento, 14)),
				'pmc_0' => $this->fixBrNumber($this->parserItem($medicamento, 15)),
				'pmc_12' => $this->fixBrNumber($this->parserItem($medicamento, 16)),
				'pmc_17' => $this->fixBrNumber($this->parserItem($medicamento, 17)),
				'pmc_18' => $this->fixBrNumber($this->parserItem($medicamento, 18)),
				'pmc_19' => $this->fixBrNumber($this->parserItem($medicamento, 19)),
				'pmc_17_zfm' => $this->fixBrNumber($this->parserItem($medicamento, 20)),
				'restricao_hospitalar' => $this->booleanSimNao($this->parserItem($medicamento, 21)),
				'cap' => $this->booleanSimNao($this->parserItem($medicamento, 22)),
				'confaz_87' => $this->booleanSimNao($this->parserItem($medicamento, 23)),
				'analise_recursal' => $this->parserItem($medicamento, 24),
				'farmacia_popular' => $this->parserItem($medicamento, 25),
				'apresentacao_reduzida' => $this->parserItem($medicamento, 26),
				'formas_farmaceuticas_solidas' => $this->parserItem($medicamento, 27),
				'formas_farmaceuticas_liquidas' => $this->parserItem($medicamento, 28),
				'formas_farmaceuticas_semisolidas' => $this->parserItem($medicamento, 29),
				'formas_farmaceuticas_gasosas' => $this->parserItem($medicamento, 30),
				'vias_de_administracao' => $this->parserItem($medicamento, 31),
				'embalagens_primarias' => $this->parserItem($medicamento, 32),
				'embalagens_secundarias' => $this->parserItem($medicamento, 33),
				'acessorios' => $this->parserItem($medicamento, 34),
			);
			if(!$this->save($medicamento)) {
				$this->log(debug($medicamento));
				return false;
			}
		}
		return true;
	}
	public function buscar($id) {
		return $this->find('first', array(
			'conditions' => array(
				'Medicamento.id' => $id,
			),
			'contain' => false,
		));
	}
	public function atualizar($data) {
		return $this->save($data);
	}
	public function atualizarPrecos($data) {
		$data['Medicamento']['pf_0'] = $this->fixBrNumber($data['Medicamento']['pf_0']);
		$data['Medicamento']['pf_12'] = $this->fixBrNumber($data['Medicamento']['pf_12']);
		$data['Medicamento']['pf_17'] = $this->fixBrNumber($data['Medicamento']['pf_17']);
		$data['Medicamento']['pf_18'] = $this->fixBrNumber($data['Medicamento']['pf_18']);
		$data['Medicamento']['pf_19'] = $this->fixBrNumber($data['Medicamento']['pf_19']);
		$data['Medicamento']['pf_17_zfm'] = $this->fixBrNumber($data['Medicamento']['pf_17_zfm']);
		$data['Medicamento']['pmc_0'] = $this->fixBrNumber($data['Medicamento']['pmc_0']);
		$data['Medicamento']['pmc_12'] = $this->fixBrNumber($data['Medicamento']['pmc_12']);
		$data['Medicamento']['pmc_17'] = $this->fixBrNumber($data['Medicamento']['pmc_17']);
		$data['Medicamento']['pmc_18'] = $this->fixBrNumber($data['Medicamento']['pmc_18']);
		$data['Medicamento']['pmc_19'] = $this->fixBrNumber($data['Medicamento']['pmc_19']);
		$data['Medicamento']['pmc_17_zfm'] = $this->fixBrNumber($data['Medicamento']['pmc_17_zfm']);
		return $this->save($data);
	}
	public function cadastrar($data) {
		$this->create();
		return $this->save($data);
	}

	// #########################################################################
	// Métodos privados ########################################################
	private function parserItem($parserArray, $i) {
		if(!isset($parserArray[$i])) {
			return null;
		}
		return trim($parserArray[$i]);
	}
}