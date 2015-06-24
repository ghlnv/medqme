<?php
App::import('Model', 'ConnectionManager');
App::import('Model', 'CakeSchema');
App::import('Utility', 'Folder');
class SystemController extends AppController {

	var $uses = null;
	var $schemaName = 'App';

	function beforeFilter() {
		Configure::write('debug', 2);
		set_time_limit(0);
		$this->Auth->allow();
	}
	function install() {
		$this->loadModel('Usuario');
		if($this->Usuario->gerarAdmin()) {
			$this->Session->setFlash('Sistema instalado com sucesso!');
		}
		else {
			$this->Session->setFlash('O sistema já estava instalado...');
		}
		$this->redirect('/');
	}
	
	function update() {
		$this->CakeSchema = new CakeSchema();

		$db = ConnectionManager::getDataSource('default');
		$old = $this->CakeSchema->read(array('models' => false));
		$new = $this->CakeSchema->load(array('name' => $this->schemaName));
		$compare = $this->CakeSchema->compare($old, $new);
		
		$drop = $create = $contents = array();
		
		//Drop table
		foreach($old['tables'] as $table => $name) {
			if(!isset($new->tables[$table])) {
				$drop[$table] = 'DROP TABLE '.$table.';';
			}
		}
		//Create or alter table
		foreach ($compare as $table => $changes) {
			if(!isset($old['tables'][$table])) {
				$create[$table] = $db->createSchema($new, $table);
			} else {
				$contents[$table] = $db->alterSchema(array($table => $changes), $table);
			}
		}
		
		$errors = array();
		
		if (!empty($drop)) {
			$error = $this->__run($drop, 'drop', $new);
			if(!empty($error)) {
				if(!is_array($error)) {
					$errors[] = $error;
				}
				else {
					$errors = array_merge($errors, $error);
				}
			}
		}
		if (!empty($create)) {
			$error = $this->__run($create, 'create', $new);
			if(!empty($error)) {
				if(!is_array($error)) {
					$errors[] = $error;
				}
				else {
					$errors = array_merge($errors, $error);
				}
			}
		}
		if (!empty($contents)) {
			$error = $this->__run($contents, 'update', $new);
			if(!empty($error)) {
				if(!is_array($error)) {
					$errors[] = $error;
				}
				else {
					$errors = array_merge($errors, $error);
				}
			}
		}
		sort($errors);
		$errors = array_reverse($errors);
		$errors = reset($errors);
		if(empty($errors)) {
			$this->Session->setFlash(__('Schema is up to date.', true));
		} else {
			$this->Session->setFlash(__('Schema is NOT up to date.', true));
		}

		$this->cleanStdCache();
		$this->redirect('/');
	}
	
	// #########################################################################
	// Métodos privados ########################################################
	function __run($contents, $event, &$Schema) {
		if (empty($contents)) {
			$this->err(__('Sql could not be run', true));
			return;
		}
		Configure::write('debug', 2);
		$db = ConnectionManager::getDataSource('default');

		$errors = null;
		foreach ($contents as $table => $sql) {
			if (empty($sql)) {
				$this->Session->setFlash(__('Schema is up to date.', true));
			} else {
				if (!$Schema->before(array($event => $table))) {
					return false;
				}
				
				$error = '';
				if (!$db->execute($sql)) {
					$error = $table . ': '  . $db->lastError();
				}

				$Schema->after(array($event => $table, 'errors' => $error));

				$errors[] = $error;
			}
		}
		return $errors;
	}
	private function cleanStdCache() {
		Cache::clear();
		$pathRaiz = APP . 'tmp/cache';
		$raiz = new Folder($pathRaiz);
		$raizFilhos = $raiz->read();
		foreach ($raizFilhos[0] as $path) {
			$path = "$pathRaiz/$path";
			$folder = new Folder($path);
			$contents = $folder->read();
			$this->excluirArquivos($path, $contents[1]);
			
			foreach ($contents[0] as $pathFolha) {
				$pathFolha = "$path/$pathFolha";
				$folhaFolder = new Folder($pathFolha);
				$folhaContents = $folhaFolder->read();
				$this->excluirArquivos($pathFolha, $folhaContents[1]);
			}
		}
	}
	private function excluirArquivos($path, $files) {
		foreach ($files as $file) {
			if(file_exists($path . DS . $file) 
			&& 'empty' != $file) {
				@unlink($path . DS . $file);
			}
		}
	}
}