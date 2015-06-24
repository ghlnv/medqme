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