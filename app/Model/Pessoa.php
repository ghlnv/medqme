<?php
class Pessoa extends AppModel {

	public $displayField = 'nome';
	public $order = array('Pessoa.nome' => 'ASC');

	public $hasOne = array(
		'Usuario' => array(
			'dependent' => true,
		),
	);
	
	public $validate = array(
		'nome' => array(
			'notEmpty' => array(
				'rule' => 'notempty',
				'message' => 'Nome não pode ficar vazio',
			),
		),
		'email' => array(
			'notEmpty' => array(
				'rule' => 'notempty',
				'message' => 'Campo obrigatório',
			),
		),
	);
	
	// #########################################################################
	// Métodos #################################################################
	public function cadastrarUsuario($pessoa) {
		if(!$this->Usuario->verificarNovaSenha($pessoa)) {
			return false;
		}
		$pessoa['Usuario']['login'] = $pessoa['Pessoa']['email'];

		$this->create();
		return $this->saveAll($pessoa, array('validate' => 'first'));
	}
	function buscarAdmin() {
		return $this->find('first', array(
			'conditions' => array('Pessoa.id' => 1),
			'contain' => array('Usuario'),
		));
	}
	public function buscarPessoaEUsuario($pessoaId) {
		return $this->find('first', array(
			'conditions' => array(
				'Pessoa.id' => $pessoaId,
			),
			'contain' => 'Usuario',
		));
	}
	function buscarPerfil($pessoaId) {
		return $this->find('first', array(
			'conditions' => array('Pessoa.id' => $pessoaId),
			'contain' => array(),
		));
	}
	public function atualizar($pessoa) {
		if(!empty($pessoa['Pessoa']['nascimento'])) {
			$this->beforeSaveBrDatetime($pessoa['Pessoa']['nascimento']);
		}
		if(!$this->save($pessoa)) {
			return false;
		}
		return true;
	}
	public function atualizarPessoaEUsuario($pessoa) {
		$this->validate = array();
		if(empty($pessoa['Pessoa']['foto'])) {
			unset($pessoa['Pessoa']['foto']);
		}
		if(!empty($pessoa['Pessoa']['nascimento'])) {
			$this->beforeSaveBrDatetime($pessoa['Pessoa']['nascimento']);
		}
		if(!$this->saveAll($pessoa)) {
			return false;
		}
		return $this->salvarFotoWebcam($pessoa);
	}
	function atualizarPerfil($pessoa) {
		if(empty($pessoa['Pessoa']['foto'])) {
			unset($pessoa['Pessoa']['foto']);
		}
		if(!empty($pessoa['Pessoa']['nascimento'])) {
			$this->beforeSaveBrDatetime($pessoa['Pessoa']['nascimento']);
		}
		if(!$this->save($pessoa)) {
			return false;
		}
		return $this->salvarFotoWebcam($pessoa);
	}
	
	function cpf( $field ) {
		foreach( $field as $key => $value ){
			$v1 = $value;
            
			if (strlen($value) < 14) {
				return false;
			}
			// Testar o formato da string
			if (!preg_match('/\d{3}\.\d{3}\.\d{3}-\d{2}/', $value)) {
				return false;
			}
			$numeros = substr($value, 0, 3) . substr($value, 4, 3) . substr($value, 8, 3) . substr($value, 12, 2);
			// Testar se todos os números estão iguais
			for ($i = 0; $i <= 9; $i++) {
				if (str_repeat($i, 11) == $numeros) {
					return false;
				}
			}
			// Testar o dígito verificador
			$dv = substr($numeros, -2);
			for ($pos = 9; $pos <= 10; $pos++) {
				$soma = 0;
				$posicao = $pos + 1;
				for ($i = 0; $i <= $pos - 1; $i++, $posicao--) {
					$soma += $numeros{$i} * $posicao;
				}
				$div = $soma % 11;
				if ($div < 2) {
					$numeros{$pos} = 0;
				} else {
					$numeros{$pos} = 11 - $div;
				}
			}
			$dvCorreto = $numeros{9} * 10 + $numeros{10};
			if ($dvCorreto != $dv) {
				return false;
			}
		}
		return true;
	}
	
	// #########################################################################
	// Métodos privados ########################################################
	private function salvarFotoWebcam($pessoa) {
		if(empty($pessoa['Pessoa']['foto'])) {
			return true;
		}

		$img = $pessoa['Pessoa']['foto']; // Your data 'data:image/png;base64,AAAFBfj42Pj4';
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);

		$pessoa['Pessoa']['foto'] = 'files/fotos/pessoa';
		$pessoa['Pessoa']['foto'].= $pessoa['Pessoa']['id'];
		$pessoa['Pessoa']['foto'].= '.png';
		file_put_contents($pessoa['Pessoa']['foto'], base64_decode($img));
		return $this->save($pessoa['Pessoa']);
	}
}