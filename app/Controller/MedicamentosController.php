<?php
class MedicamentosController extends AppController {

	public $paginate;
	
	// #########################################################################
	// Ações ###################################################################
	public function index() {
		if($this->Role->isAdmin()) {
			$this->admin_index();
			$this->render('admin_index');
		}
		else {
			$this->Role->error();
		}
	}
	public function autocompleteNome() {
		$this->set('data', $this->Medicamento->nomesUnicos($_GET['term']));
		$this->render('admin_jsonAutocomplete');
	}

	// #########################################################################
	// Ações do admin ##########################################################
	public function admin_autocompletePrincipioAtivo() {
		$this->set('data', $this->Medicamento->principiosAtivosUnicos($_GET['term']));
		$this->render('admin_jsonAutocomplete');
	}
	public function admin_autocompleteNome() {
		$this->autocompleteNome();
	}
	public function admin_cadastrar() {
		if(!empty($this->request->data)) {
			if($this->Medicamento->cadastrar($this->request->data)) {
				$this->Session->setFlash(__('Medicamento cadastrado com sucesso!', true), 'flash/success');
				$this->contentReload();
			}
			else {
				$this->Session->setFlash(__('Medicamento NÃO cadastrado. Verifique os erros no formulário.', true));
			}
		}
	}
	public function admin_importar() {
		if(!empty($this->request->data)) {
			if($this->Medicamento->importar($this->request->data)) {
				$this->Session->setFlash(__('Medicamentos importados com sucesso!', true), 'flash/success');
				$this->windowReload();
			}
			else {
				$this->Session->setFlash(__('Medicamentos NÃO importados. Verifique os erros no formulário.', true));
			}
		}
	}
	public function admin_excluir($ausenciaId) {
		if (!$ausenciaId) {
			$this->Session->setFlash(__('Id inválido para o medicamento', true));
		}
		else {
			if ($this->Medicamento->delete($ausenciaId, true)) {
				$this->Session->setFlash(__('Medicamento excluído com sucesso!', true), 'flash/success');
			}
		}
		$this->redirect($this->referer());
	}
	public function admin_editarPrecos($id) {
		if (!empty($this->request->data)) {
			if ($this->Medicamento->atualizarPrecos($this->request->data)) {
				$this->Session->setFlash(__('Medicamento atualizado com sucesso.', true), 'flash/success');
				$this->contentReload();
				$this->fecharDialog();
			}
			else {
				$this->Session->setFlash(__('Medicamento NÃO atualizado. Verifique os erros no formulário.', true));
			}
		}
		else {
			$this->request->data = $this->Medicamento->buscar($id);
		}
	}
	public function admin_editar($id) {
		if (!empty($this->request->data)) {
			if ($this->Medicamento->atualizar($this->request->data)) {
				$this->Session->setFlash(__('Medicamento atualizado com sucesso.', true), 'flash/success');
				$this->contentReload();
				$this->fecharDialog();
			}
			else {
				$this->Session->setFlash(__('Medicamento NÃO atualizado. Verifique os erros no formulário.', true));
			}
		}
		else {
			$this->request->data = $this->Medicamento->buscar($id);
		}
	}
	public function admin_index() {
		if(!empty($this->request->params['named']['keywords'])) {
			$tokens = explode(' ', trim($this->request->params['named']['keywords']));
			foreach($tokens as $token) {
				$this->paginate['Medicamento']['conditions'][]['OR'] = array(
					'Medicamento.codigo LIKE' => "%$token%",
					'Medicamento.principio_ativo LIKE' => "%$token%",
					'Medicamento.laboratorio LIKE' => "%$token%",
					'Medicamento.codigo_ggrem LIKE' => "%$token%",
					'Medicamento.nome LIKE' => "%$token%",
					'Medicamento.apresentacao LIKE' => "%$token%",
					'Medicamento.classe_terapeutica LIKE' => "%$token%",
				);
			}
		}
		$this->paginate['Medicamento']['contain'] = false;
		$this->set('medicamentos', $this->paginate('Medicamento'));
	}

	// #########################################################################
	// Métodos privados ########################################################
}