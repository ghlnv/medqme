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
		'telefone' => array(
			'notEmpty' => array(
				'rule' => 'notempty',
				'message' => 'Campo obrigatório',
			),
		),
		'nascimento' => array(
			'notEmpty' => array(
				'rule' => 'notempty',
				'message' => 'Campo obrigatório',
			),
		),
	);
	
	// #########################################################################
	// Métodos #################################################################
	public function buscarPacientesIdsDoMedico($medicoId) {
		return Set::extract('/Pessoa/id', $this->find('all', array(
			'fields' => array(
				'Pessoa.id',
			),
			'conditions' => array(),
			'contain' => array(),
			'joins' => array(
				array(
					'table' => 'consultas',
					'alias' => 'Consulta',
					'type' => 'INNER',
					'conditions' => array(
						'Pessoa.id = Consulta.pessoa_id',
						'Consulta.medico_id' => $medicoId,
					),
				),
			),
			'group' => array('Pessoa.id'),
		)));
	}
	public function iniciaisDePacientes() {
		$fields = array();
		$letras = range('A', 'Z');
		foreach($letras as $letra) {
			$fields[] = "SUM(IF(LEFT(Pessoa.nome, 1) = '$letra', 1,0)) AS $letra";
		}
		
		return reset($this->find('first', array(
			'fields' => $fields,
			'conditions' => array(
				'Pessoa.id <>' => 1,
				'OR' => array(
					'Usuario.id IS NULL',
					'Usuario.tipo IS NULL',
				),
			),
			'contain' => array('Usuario'),
		)));
	}
	public function buscarPacienteFicha($pessoaId) {
		return $this->find('first', array(
			'conditions' => array(
				'Pessoa.id' => $pessoaId,
			),
			'contain' => false,
		));
	}
	public function idDoUltimoPaciente() {
		$pessoa = $this->find('first', array(
			'fields' => array('Pessoa.id'),
			'conditions' => array(
				'Pessoa.id <>' => 1,
				'OR' => array(
					'Usuario.id IS NULL',
					'Usuario.tipo IS NULL',
				),
			),
			'contain' => array('Usuario'),
			'order' => array('Pessoa.modified' => 'DESC'),
		));
		if(empty($pessoa)) {
			return false;
		}
		return $pessoa['Pessoa']['id'];
	}
	public function listarMedicos() {
		return $this->find('list', array(
			'conditions' => array(
				'OR' => array(
					array('Usuario.tipo' => 'Saude'),
					array('Usuario.tipo' => 'Saude Basica'),
				),
			),
			'contain' => array('Usuario.tipo'),
		));
	}
	public function listarPacientes() {
		return $this->find('list', array(
			'conditions' => array(
				'Pessoa.id <>' => 1,
				'OR' => array(
					'Usuario.id IS NULL',
					'Usuario.tipo IS NULL',
				),
			),
			'contain' => array('Usuario'),
		));
	}
	public function cadastrarPaciente($pessoa) {
		if(!empty($pessoa['Pessoa']['nascimento'])) {
			$this->beforeSaveBrDatetime($pessoa['Pessoa']['nascimento']);
		}
		
		$this->create();
		if(!$this->save($pessoa)) {
			return false;
		}
		$pessoa['Pessoa']['id'] = $this->getLastInsertID();
		return $this->salvarFotoWebcam($pessoa);
	}
	public function cadastrarStaff($pessoa) {
		$pessoa['Usuario']['login'] = $pessoa['Pessoa']['email'];
		$pessoa['Usuario']['senha'] = AuthComponent::password($pessoa['Pessoa']['email']);
		
		$this->create();
		if(!$this->saveAll($pessoa, array('validate' => 'first'))) {
			return false;
		}
		return true;
	}
	public function cadastrarUsuario($pessoa) {
		if(!$this->Usuario->verificarNovaSenha($pessoa)) {
			return false;
		}
		$pessoa['Usuario']['login'] = $pessoa['Pessoa']['email'];

		$this->create();
		return $this->saveAll($pessoa, array('validate' => 'first'));
	}
	function getRole($pessoaId) {
		return $this->find('first', array(
			'fields' => array(
				'Pessoa.id',
				'Pessoa.nome',
				'Pessoa.email',
			),
			'conditions' => array('Pessoa.id' => $pessoaId),
			'contain' => false,
		));
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
	
	function buscarPessoaIdDoAlunoTurma($alunoTurmaId) {
		$pessoa = $this->find('first', array(
			'fields' => array(
				'Pessoa.id'
			),
			'conditions' => array(
				'AlunoTurma.id IS NOT NULL',
			),
			'contain' => array(),
			'joins' => array(
				array(
					'table' => 'alunos',
					'alias' => 'Aluno',
					'type' => 'LEFT',
					'conditions' => array(
						'Pessoa.id = Aluno.pessoa_id',
					),
				),
				array(
					'table' => 'aluno_turmas',
					'alias' => 'AlunoTurma',
					'type' => 'LEFT',
					'conditions' => array(
						'Aluno.id = AlunoTurma.aluno_id',
						"AlunoTurma.id = $alunoTurmaId",
					),
				),
			)
		));
		return $pessoa['Pessoa']['id'];
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