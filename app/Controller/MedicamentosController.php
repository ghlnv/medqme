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

	// #########################################################################
	// Ações do admin ##########################################################
	public function admin_cadastrar() {
		if(!empty($this->request->data)) {
			if($this->Medicamento->cadastrar($this->request->data)) {
				$this->Session->setFlash(__('Medicamento cadastrado com sucesso!', true), 'flash/success');
				$this->windowReload();
			}
			else {
				$this->Session->setFlash(__('Medicamento NÃO cadastrado. Verifique os erros no formulário.', true));
			}
		}
//		$this->set('pessoas', $this->Pessoa->listarMedicos());
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
	public function admin_editar($id) {
		if (!empty($this->request->data)) {
			if ($this->Medicamento->save($this->request->data)) {
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
		if(!empty($this->request->params['named']['data_minima'])) {
			$this->paginate['Medicamento']['conditions']['Medicamento.data >='] = date('Y-m-d', strtotime($this->request->params['named']['data_minima']));
		}
		if(!empty($this->request->params['named']['data_maxima'])) {
			$this->paginate['Medicamento']['conditions']['Medicamento.data <='] = date('Y-m-d', strtotime($this->request->params['named']['data_maxima']));
		}
		if(!empty($this->request->params['named']['pessoa_id'])) {
			$this->paginate['Medicamento']['conditions']['Medicamento.pessoa_id'] = $this->request->params['named']['pessoa_id'];
		}
		$this->paginate['Medicamento']['contain'] = false;
		$this->set('medicamentos', $this->paginate('Medicamento'));
//		$this->set('pessoas', $this->Pessoa->listarMedicos());
	}

	// #########################################################################
	// Métodos privados ########################################################
}