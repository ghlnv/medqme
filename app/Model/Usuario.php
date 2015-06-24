<?php
class Usuario extends AppModel {

	var $name = 'Usuario';
	
	var $belongsTo = array(
		'Pessoa',
	);
	
	var $validate = array(
		'pessoa_id' => array(
			'isUnique' => array(
				'rule' => 'isUnique', 
				'message' => 'Esta pessoa já esta cadastrada como usuário',
				'allowEmpty' => true
			),
		),
		'login' => array(
			'notEmpty' => array(
				'rule' => 'notempty',
				'message' => 'Campo obrigatório',
			),
			'isUnique' => array(
				'rule' => 'isUnique', 
				'message' => 'Login já existente',
				'allowEmpty' => true
			),
		),
		'senha' => array(
			'notEmpty' => array(
				'rule' => 'notempty',
				'message' => 'Campo obrigatório',
			),
		),
		'senha_atual' => array(
			'notEmpty' => array(
				'rule' => 'notempty',
				'message' => 'Campo obrigatório',
			),
		),
		'nova_senha' => array(
			'notEmpty' => array(
				'rule' => 'notempty',
				'message' => 'Campo obrigatório',
			),
		),
		'confirm' => array(
			'notEmpty' => array(
				'rule' => 'notempty',
				'message' => 'Campo obrigatório',
			),
		),
		'tipo' => array(
			'notEmpty' => array(
				'rule' => 'notempty',
				'message' => 'Campo obrigatório',
			),
		),
	);
	
	
	// #########################################################################
	// Métodos públicos ########################################################
	public function cadastrar($usuario) {
		App::uses('CakeEmail', 'Network/Email');
		if(!$this->Pessoa->save($usuario['Pessoa'])) {
			return false;
		}
		$usuario['Usuario']['pessoa_id'] = $this->Pessoa->getLastInsertID();
		$usuario['Usuario']['login'] = $usuario['Pessoa']['email'];
		$usuario['Usuario']['nova_senha'] = $this->gerarSenhaComString($usuario['Pessoa']['email']);
		$usuario['Usuario']['senha'] = AuthComponent::password($usuario['Usuario']['nova_senha']);
		
		if(!$this->save($usuario['Usuario'])) {
			return false;
		}
		$usuario['Usuario']['id'] = $this->getLastInsertID();
		
		$this->enviarEmailSobreUsuarioCadastrado($usuario);
		$this->reportarAdminSobreUsuarioCadastrado($usuario);
		return $usuario;
	}
	public function gerarAdmin() {
		$admin = $this->field('id', array('Usuario.id' => 1));
		if(!empty($admin)) {
			return false;
		}
		$admin = array(
			'Pessoa' => array(
				'id' => 1,
				'nome' => 'Administrador',
			),
			'Usuario' => array(
				'id' => 1,
				'pessoa_id' => 1,
				'login' => 'admin',
				'senha' => AuthComponent::password(123),
			),
		);
		return $this->Pessoa->saveAll($admin);
	}
	function getByPessoaId($pessoaId) {
		$this->contain();
		$usuario = $this->findByPessoaId($pessoaId);
		return $usuario['Usuario'];
	}
	function buscarUsuarioIdDaPessoa($pessoaId) {
		return $this->field('id', array('pessoa_id' => $pessoaId));
	}
	function buscarIdPeloLogin($login) {
		return $this->field('id', array(
			'Usuario.login' => $login,
		));
	}
	function buscarAdmin() {
		return $this->find('first', array(
			'conditions' => array(
				'Usuario.id' => 1,
			),
			'contain' => array(
				'Pessoa'
			),
		));
	}
	public function buscarParaEditar($usuarioId) {
		return $this->find('first', array(
			'conditions' => array(
				'Usuario.id' => $usuarioId,
			),
			'contain' => array(),
		));
	}
	public function atualizar($usuario) {
		if(!$this->verificarNovaSenha($usuario)) {
			return false;
		}
		return $this->save($usuario);
	}
	public function alterarSenha($usuario) {
		if(empty($usuario['Usuario']['senha_atual'])) {
			$this->invalidate('senha_atual', 'Você precisa digitar sua senha atual');
			return false;
		}
		$usuarioId = $this->field('id', array(
			'id' => $usuario['Usuario']['id'],
			'senha' => AuthComponent::password($usuario['Usuario']['senha_atual']),
		));
		if(!$usuarioId) {
			$this->invalidate('senha_atual', 'Senha atual inválida');
			return false;
		}
		if(!$this->verificarNovaSenha($usuario)) {
			return false;
		}
		return $this->save($usuario);
	}
	public function verificarNovaSenha(&$usuario) {
		if(empty($usuario['Usuario']['nova_senha'])) {
			$this->invalidate('nova_senha', 'Você precisa digitar uma nova senha');
			return false;
		}
		if(empty($usuario['Usuario']['confirm'])) {
			$this->invalidate('confirm', 'Você precisa confirmar sua nova senha');
			return false;
		}
		if($usuario['Usuario']['nova_senha'] != $usuario['Usuario']['confirm']) {
			$this->invalidate('confirm', 'Sua confirmação precisa ser idêntica à nova senha');
			return false;
		}
		
		$usuario['Usuario']['senha'] = AuthComponent::password($usuario['Usuario']['nova_senha']);
		return true;
	}
	public function requererNovaSenha($data) {
		$usuario = $this->find('first', array(
			'fields' => array(
				'Usuario.id',
				'Usuario.login',
				'Usuario.senha',
			),
			'conditions' => array(
				'Usuario.login' => $data['Usuario']['login'],
				'OR' => array(
					'Usuario.requerimento_senha IS NULL',
					'Usuario.requerimento_senha <' => date('Y-m-d H:i:s', strtotime('-10 minutes')),
				)
			),
			'contain' => array('Pessoa.nome'),
		));
		
		if(empty($usuario['Usuario']['id'])) {
			return false;
		}

		$usuario['Usuario']['requerimento_senha'] = date('Y-m-d H:i:s');
		if(!$this->save($usuario['Usuario'])) {
			return false;
		}
		
		$this->enviarEmailSobreLinkParaTrocarSenha($usuario);
		return true;
	}
	public function buscarParaDefinirNovaSenha($usuarioId, $token) {
		$usuario = $this->find('first', array(
			'fields' => array(
				'Usuario.id',
				'Usuario.login',
				'Usuario.senha',
				'Usuario.requerimento_senha',
			),
			'conditions' => array(
				'Usuario.id' => $usuarioId,
				'Usuario.requerimento_senha IS NOT NULL',
			),
			'contain' => array('Pessoa'),
		));
		if(empty($usuario['Usuario']['id'])) {
			return false;
		}
		
		if($this->gerarTokenParaTrocarSenha($usuario) != $token) {
			return false;
		}
		
		return $usuario;
	}
	public function gerarNovaSenha($data, $token) {
		$usuario = $this->find('first', array(
			'fields' => array(
				'Usuario.id',
				'Usuario.pessoa_id',
				'Usuario.login',
				'Usuario.senha',
				'Usuario.requerimento_senha',
			),
			'conditions' => array(
				'Usuario.id' => $data['Usuario']['id'],
				'Usuario.login' => $data['Usuario']['login'],
			),
			'contain' => array(
				'Pessoa' => array(
					'fields' => array(
						'Pessoa.id',
						'Pessoa.nome',
						'Pessoa.email',
					),
				),
			),
		));
		if(empty($usuario['Usuario']['id'])) {
			return false;
		}
		if(empty($usuario['Pessoa']['email'])) {
			return false;
		}
		if($this->gerarTokenParaTrocarSenha($usuario) != $token) {
			return false;
		}
		
		$usuario['Usuario']['nova_senha'] = $data['Usuario']['nova_senha'];
		$usuario['Usuario']['confirm'] = $data['Usuario']['confirm'];
		if(!$this->verificarNovaSenha($usuario)) {
			return false;
		}
		
		$usuario['Usuario']['requerimento_senha'] = null;
		if(!$this->save($usuario['Usuario'])) {
			return false;
		}
		
		$this->enviarEmailSobreNovaSenhaGerada($usuario);
		$this->reportarAdminSobreNovaSenhaGerada($usuario);
		return $usuario;
	}
	public function gerarSenhaComString($string) {
		return substr(AuthComponent::password($string), 0, 6);
	}
	
	// #########################################################################
	// Métodos privados ########################################################
	private function enviarEmailSobreUsuarioCadastrado(&$usuario) {
		$email = new CakeEmail('smtp');
		$email->template('usuario_cadastro');
		$email->viewVars(array(
			'usuario' => $usuario,
		));
		$email->to($usuario['Pessoa']['email']);
		$email->subject('Cadastro no Cozinha Legal efetuado com sucesso!');
		$email->send();
	}
	private function reportarAdminSobreUsuarioCadastrado(&$usuario) {
		$admin = $this->buscarAdmin();
		
		$email = new CakeEmail('default');
		$email->template('admin_novo_cadastro');
		$email->viewVars(array(
			'admin' => $admin,
			'usuario' => $usuario,
		));
		$email->to($admin['Pessoa']['email']);
		$email->subject('Novo cadastro efetuado no Cozinha Legal!');
		$email->send();
	}
	private function gerarTokenParaTrocarSenha(&$usuario) {
		$token = '';
		$token.= $usuario['Usuario']['senha'];
		$token.= $usuario['Usuario']['requerimento_senha'];
		$token = md5($token);
		return $token;
	}
	private function enviarEmailSobreLinkParaTrocarSenha(&$usuario) {
		$token = $this->gerarTokenParaTrocarSenha($usuario);
		
		$this->Email = new CakeEmail('smtp');
		$this->Email->template('usuario_requerimento_senha');
		$this->Email->viewVars(compact('usuario', 'token'));
		$this->Email->subject('Nova senha para login no Clinimap requerida com sucesso!');

		$this->Email->to($usuario['Usuario']['login']);
		$this->Email->send();
	}
	private function enviarEmailSobreNovaSenhaGerada(&$usuario) {
		$this->Email = new CakeEmail('smtp');
		$this->Email->template('usuario_nova_senha');
		$this->Email->viewVars(compact('usuario'));
		$this->Email->subject('Nova senha para login no Clinimap cadastrada com sucesso!');

		$this->Email->to($usuario['Usuario']['login']);
		$this->Email->send();
	}
	private function reportarAdminSobreNovaSenhaGerada(&$usuario) {
		$this->loadModel('Pessoa');
		$admin = $this->Pessoa->buscarAdmin();
		
		$this->Email = new CakeEmail('default');
		$this->Email->template('admin_nova_senha');
		$this->Email->viewVars(compact('admin', 'usuario'));
		$this->Email->subject('Usuário gerou nova senha para login no Clinimap!');

		$this->Email->to($admin['Pessoa']['email']);
		$this->Email->send();
	}
}