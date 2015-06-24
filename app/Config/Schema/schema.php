<?php 
class AppSchema extends CakeSchema {
	var $name = 'App';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $pessoas = array(
		'id' => array(
			'type' => 'integer',
			'null' => false,
			'default' => NULL,
			'key' => 'primary'
		),
		'nome' => array(
			'type' => 'string',
			'null' => false,
			'default' => NULL
		),
		'responsavel' => array(
			'type' => 'string',
			'null' => false,
			'default' => NULL
		),
		'foto' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 512
		),
		'nascimento' => array(
			'type' => 'date', 
			'null' => true, 
			'default' => NULL
		),
		'estado_civil' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 64
		),
		'profissao' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 64
		),
		'rg' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 64
		),
		'cpf' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 64
		),
		'cr_documento' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 8
		),
		'cr' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 64
		),
		'assinatura' => array(
			'type' => 'text',
			'null' => true,
			'default' => NULL,
		),
		'telefone' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 20
		),
		'telefone_alternativo' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 20
		),
		'email' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 128
		),
		'logradouro' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 96,
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci'
		),
		'numero' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 16,
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci'
		),
		'complemento' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 16,
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci'
		),
		'bairro' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 32,
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci'
		),
		'cidade' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 96,
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci'
		),
		'estado' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 2,
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci'
		),
		'pais' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 96,
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci'
		),
		'cep' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 20,
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci'
		),
		'created' => array(
			'type' => 'datetime',
			'null' => true,
			'default' => NULL
		),
		'modified' => array(
			'type' => 'datetime',
			'null' => true,
			'default' => NULL
		),
		'indexes' => array(
			'PRIMARY' => array(
				'column' => 'id',
				'unique' => 1
			)
		),
		'tableParameters' => array(
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci',
			'engine' => 'MyISAM'
		)
	);
	var $usuarios = array(
		'id' => array(
			'type' => 'integer',
			'null' => false,
			'default' => NULL,
			'key' => 'primary'
		),
		'pessoa_id' => array(
			'type' => 'integer',
			'null' => false,
			'default' => NULL,
			'key' => 'index'
		),
		'login' => array(
			'type' => 'string',
			'null' => false,
			'default' => NULL,
			'length' => 64
		),
		'senha' => array(
			'type' => 'string',
			'null' => false,
			'default' => NULL,
			'length' => 40
		),
		'tipo' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 64
		),
		'created' => array(
			'type' => 'datetime',
			'null' => true,
			'default' => NULL
		),
		'modified' => array(
			'type' => 'datetime',
			'null' => true,
			'default' => NULL
		),
		'indexes' => array(
			'PRIMARY' => array(
				'column' => 'id',
				'unique' => 1
			),
			'fk_usuarios_pessoas' => array(
				'column' => 'pessoa_id',
				'unique' => 0
			),
		),
		'tableParameters' => array(
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci',
			'engine' => 'MyISAM'
		)
	);
	var $usuarios_logs = array(
		'id' => array(
			'type' => 'integer',
			'null' => false,
			'default' => NULL,
			'key' => 'primary'
		),
		'usuario_id' => array(
			'type' => 'integer',
			'null' => false,
			'default' => NULL,
			'key' => 'index'
		),
		'ip' => array(
			'type' => 'string',
			'null' => false,
			'length' => 64,
			'key' => 'index',
		),
		'url' => array(
			'type' => 'string',
			'null' => true,
			'length' => 1024,
			'key' => 'index',
		),
		'referer' => array(
			'type' => 'string',
			'null' => true,
			'length' => 1024,
		),
		'descricao' => array(
			'type' => 'string',
			'null' => true,
			'length' => 1024,
		),
		'post' => array(
			'type' => 'text',
			'null' => true,
		),
		'created' => array(
			'type' => 'datetime',
			'null' => true,
			'default' => NULL
		),
		'modified' => array(
			'type' => 'datetime',
			'null' => true,
			'default' => NULL
		),
		'indexes' => array(
			'PRIMARY' => array(
				'column' => 'id',
				'unique' => 1
			),
			'fk_sessoes_usuarios1' => array(
				'column' => 'usuario_id',
				'unique' => 0
			),
			'index_url' => array(
				'column' => 'url',
				'unique' => 0
			),
			'index_ip' => array(
				'column' => 'ip',
				'unique' => 0
			),
			'index_descricao' => array(
				'column' => 'descricao',
				'unique' => 0
			),
			'index_created' => array(
				'column' => 'created',
				'unique' => 0
			),
		),
		'tableParameters' => array(
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci',
			'engine' => 'InnoDB'
		)
	);
}
