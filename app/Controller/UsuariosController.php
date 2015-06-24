<?php
class UsuariosController extends AppController {

	public $paginate;
	
	public function beforeFilter() {
		AppController::beforeFilter();
		$this->Auth->allow(array(
			'cadastro',
			'captcha_image',
			'esqueciMinhaSenha',
			'definirNovaSenha',
		));
		$this->set('title_for_layout', 'Login');
		$this->Auth->autoRedirect = false;
	}
	
	// #########################################################################
	// Ações públicas ##########################################################
	public function cadastro() {
		if(AuthComponent::user('id')) {
			$this->Session->setFlash(__('Você precisa sair para realizar um novo cadastro.', true));
			$this->redirect('/');
		}
		if($this->request->is('post')) {
			if(!$this->Captcha->check($this->request->data['Usuario']['captcha'])) {
				$this->Session->setFlash(__('Você precisa digitar as letras corretamente.', true));
				$this->request->data['Usuario']['captcha'] = null;
			}
			else {
				$usuario = $this->Usuario->cadastrar($this->request->data);
				if($usuario) {
					$this->Auth->login($usuario['Usuario']);
					$this->Session->setFlash("Seu cadastrado foi realizado com sucesso! Sua senha inicial foi enviada para seu e-mail. Boas receitas!", 'flash/success');
				}
				else {
					$this->Session->setFlash(__('Seu email não pode ser cadastrado, por favor tente novamente...', true));
				}
				$this->request->data['Usuario']['captcha'] = null;
			}
		}
		$this->redirect($this->referer());
	}
	public function login() {
		if($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->loadModel('UsuariosLog');
//				$this->UsuariosLog->insert('Login');
				return $this->redirect($this->Auth->redirect());
			}
			else {
				$this->Session->setFlash(__('Login e/ou senha incorretos'), 'default', array(), 'auth');
			}
		}
		if(AuthComponent::user('id')) {
			$this->redirect($this->Auth->redirect());
		}
//		$this->layout = 'login';
	}
	public function sair() {
//		$this->loadModel('UsuariosLog');
//		$this->UsuariosLog->insert('Logout');
		$this->Session->destroy();
		$this->Session->setFlash('Obrigado por usar nossos sistemas!', 'flash/success');
		$this->redirect($this->Auth->logout());
	}
	public function esqueciMinhaSenha() {
		$this->verificarUsuarioDeslogado();
		
		if(!empty($this->request->data)) {
			if(!$this->Captcha->check($this->request->data['Usuario']['captcha'])) {
				$this->Session->setFlash(__('Você precisa digitar as seis letras corretamente.', true));
			}
			else {
				if($this->Usuario->requererNovaSenha($this->request->data)) {
					$this->Session->setFlash("Sua nova senha foi requerida com sucesso! Verifique seu e-mail para cadastrar sua nova senha...", 'flash/success');
					$this->windowReload();
				}
				else {
					$this->Session->setFlash(__('Sua nova senha não pode ser requerida, por favor confira seu login e tente novamente...', true));
				}
			}
			$this->request->data['Usuario']['captcha'] = null;
		}
	}
	public function definirNovaSenha($usuarioId, $token) {
		$this->verificarUsuarioDeslogado();
		
		if(!empty($this->request->data)) {
			$usuario = $this->Usuario->gerarNovaSenha($this->request->data, $token);
			if($usuario) {
				$this->Session->setFlash("Sua nova senha foi gerada com sucesso!", 'flash/success');
				$this->Auth->login($usuario['Usuario']);
				$this->redirect('/painel');
			}
			else {
				$this->Session->setFlash(__('Sua nova senha não pode ser gerada, por favor confira seus dados e tente novamente...', true));
			}
		}
		$this->request->data = $this->Usuario->buscarParaDefinirNovaSenha($usuarioId, $token);
		
		if(!$this->request->data) {
			$this->redirect('/');
		}
	}
	public function captcha_image() { 
		$this->Captcha->image();
		exit;
	}	

	// #########################################################################
	// Ações de saúde ##########################################################
	public function saude_login() {
		$this->login();
		$this->render('login');
	}

	// #########################################################################
	// Ações de saúde ##########################################################
	public function saudebasica_login() {
		$this->login();
		$this->render('login');
	}

	// #########################################################################
	// Ações do recepcionista ##################################################
	public function recepcionista_login() {
		$this->login();
		$this->render('login');
	}

	// #########################################################################
	// Ações da atendente ######################################################
	public function atendente_login() {
		$this->login();
		$this->render('login');
	}

	// #########################################################################
	// Ações do gerente ########################################################
	public function gerente_login() {
		$this->login();
		$this->render('login');
	}
	
	// #########################################################################
	// Ações do admin ##########################################################
	public function admin_relatorioLogins() {
		$this->layout = 'popup';
		$this->loadModel('UsuariosLog');
		
		if(empty($this->request->params['named']['data_minima'])) {
			$this->request->params['named']['data_minima'] = $dataMinima = date('d-m-Y', strtotime('now -1 month'));
		}
		if(empty($this->request->params['named']['data_maxima'])) {
			$this->request->params['named']['data_maxima'] = $dataMaxima = date('d-m-Y');
		}
		
		$this->paginate['UsuariosLog']['conditions'] = array(
			'UsuariosLog.created >=' => date('Y-m-d', strtotime($this->request->params['named']['data_minima'])),
			'UsuariosLog.created <=' => date('Y-m-d 23:59:59', strtotime($this->request->params['named']['data_maxima'])),
		);
		$this->paginate['UsuariosLog']['contain'] = array('Usuario.Pessoa');
		$usuariosLogs = $this->paginate('UsuariosLog');
		
		$staffsNoPeriodo = $this->UsuariosLog->countStaff($this->request->params['named']['data_minima'], $this->request->params['named']['data_maxima']);
		$loginsNoPeriodo = $this->UsuariosLog->countLogins($this->request->params['named']['data_minima'], $this->request->params['named']['data_maxima']);
		$this->set(compact('usuariosLogs', 'staffsNoPeriodo', 'loginsNoPeriodo'));
	}
	public function admin_editar($usuarioId) {
		if(!empty($this->request->data)) {
			if ($this->Usuario->atualizar($this->request->data)) {
				$this->Session->setFlash(__('Login atualizado com sucesso!', true), 'flash/success');
				$this->contentReload();
				$this->fecharDialog();
			}
			else {
				$this->Session->setFlash(__('O login NÃO pode ser atualizado! Por favor tente novamente...', true));
			}
		}
		else {
			$this->request->data = $this->Usuario->buscarParaEditar($usuarioId);
		}
	}
	function admin_login() {
		$this->login();
		$this->render('login');
	}

	// #########################################################################
	// Métodos privados ########################################################
	private function verificarUsuarioDeslogado() {
		if(AuthComponent::user('id')) {
			$this->errorRedirect('Você precisa deslogar do sistema para informar senha perdida.');
		}
	}
}