<?php
class PessoasController extends AppController {

	public $paginate;
	
	// #########################################################################
	// Ações ###################################################################
	function meuPerfil() {
		$this->salvarMeuPerfil();
		$this->request->data = $this->Pessoa->buscarPessoaEUsuario(AuthComponent::user('pessoa_id'));
	}
	
	// #########################################################################
	// Ações do admin ##########################################################
	public function admin_index() {
		if(!empty($this->request->params['named']['keywords'])) {
			$tokens = explode(' ', trim($this->request->params['named']['keywords']));
			foreach($tokens as $token) {
				$this->paginate['Pessoa']['conditions'][]['OR'] = array(
					'Pessoa.nome LIKE' => "%$token%",
					'Pessoa.logradouro LIKE' => "%$token%",
					'Pessoa.cidade LIKE' => "%$token%",
					'Pessoa.estado LIKE' => "%$token%",
				);
			}
		}
		$this->paginate['Pessoa']['conditions']['NOT']['Pessoa.id'] = 1;
		$this->paginate['Pessoa']['contain'] = false;
		$this->set([
			'pessoas' => $this->paginate('Pessoa'),
		]);
	}
	public function admin_excluir($pessoaId) {
		if (!$pessoaId) {
			$this->Session->setFlash(__('Id inválido para a pessoa', true));
		}
		else {
			if ($this->Pessoa->delete($pessoaId, true)) {
				$this->Session->setFlash(__('Pessoa excluída com sucesso!', true), 'flash/success');
			}
		}
		$this->redirect($this->referer());
	}
	public function admin_editar($pessoaId) {
		if ($this->request->is('put')) {
			if(!empty($this->request->data['Pessoa'])) {
				if ($this->Pessoa->atualizar($this->request->data)) {
					$this->Session->setFlash(__('Perfil atualizado com sucesso.', true), 'flash/success');
				}
				else {
					$this->Session->setFlash(__('Perfil NÃO atualizado. Verifique os erros no formulário.', true));
				}
			}
			else if(!empty($this->request->data['Usuario'])) {
				$this->loadModel('Usuario');
				if ($this->Usuario->atualizar($this->request->data)) {
					$this->Session->setFlash(__('A nova senha foi cadastrada com sucesso.', true), 'flash/success');
				}
				else {
					$this->Session->setFlash(__('A nova senha NÃO pode ser cadastrada!', true));
				}
			}
		}
		$this->request->data = $this->Pessoa->buscarPerfil($pessoaId);
	}

	// #########################################################################
	// Métodos privados ########################################################
	private function salvarMeuPerfil() {
		if (!empty($this->request->data)) {
			if(!empty($this->request->data['Pessoa'])) {
				if ($this->Pessoa->save($this->request->data['Pessoa'])) {
					$this->Session->setFlash(__('Perfil atualizado com sucesso.', true), 'flash/success');
				}
				else {
					$this->Session->setFlash(__('Perfil NÃO atualizado. Verifique os erros no formulário.', true));
				}
			}
			else if(!empty($this->request->data['Usuario'])) {
				$this->loadModel('Usuario');
				if ($this->Usuario->alterarSenha($this->request->data)) {
					$this->Session->setFlash(__('A nova senha foi cadastrada com sucesso.', true), 'flash/success');
				}
				else {
					$this->Session->setFlash(__('A nova senha NÃO pode ser cadastrada!', true));
				}
			}
			$this->Role->updatePessoa();
		}
	}
}