<?php 
class AppSchema extends CakeSchema {
	var $name = 'App';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $medicamentos = array(
		'id' => array(
			'type' => 'integer',
			'null' => false,
			'default' => NULL,
			'key' => 'primary'
		),
		'codigo' => array(
			'type' => 'string',
			'length' => 8,
			'null' => true,
			'default' => NULL
		),
		'principio_ativo' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL
		),
		'cnpj' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL
		),
		'laboratorio' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL
		),
		'codigo_ggrem' => array(
			'type' => 'string',
			'length' => 24,
			'null' => true,
			'default' => NULL
		),
		'ean' => array(
			'type' => 'string',
			'length' => 24,
			'null' => true,
			'default' => NULL
		),
		'nome' => array(
			'type' => 'string',
			'null' => false,
			'default' => NULL
		),
		'apresentacao' => array(
			'type' => 'text',
			'null' => false,
			'default' => NULL
		),
		'classe_terapeutica' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL
		),
		'dosagem' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL
		),
		'unidade' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL
		),
		'pf_0' => array(
			'type' => 'float',
			'null' => true,
			'default' => NULL
		),
		'pf_12' => array(
			'type' => 'float',
			'null' => true,
			'default' => NULL
		),
		'pf_17' => array(
			'type' => 'float',
			'null' => true,
			'default' => NULL
		),
		'pf_18' => array(
			'type' => 'float',
			'null' => true,
			'default' => NULL
		),
		'pf_19' => array(
			'type' => 'float',
			'null' => true,
			'default' => NULL
		),
		'pf_17_zfm' => array(
			'type' => 'float',
			'null' => true,
			'default' => NULL
		),
		'pmc_0' => array(
			'type' => 'float',
			'null' => true,
			'default' => NULL
		),
		'pmc_12' => array(
			'type' => 'float',
			'null' => true,
			'default' => NULL
		),
		'pmc_17' => array(
			'type' => 'float',
			'null' => true,
			'default' => NULL
		),
		'pmc_18' => array(
			'type' => 'float',
			'null' => true,
			'default' => NULL
		),
		'pmc_19' => array(
			'type' => 'float',
			'null' => true,
			'default' => NULL
		),
		'pmc_17_zfm' => array(
			'type' => 'float',
			'null' => true,
			'default' => NULL
		),
		'restricao_hospitalar' => array(
			'type' => 'boolean',
			'null' => true,
			'default' => NULL
		),
		'cap' => array(
			'type' => 'boolean',
			'null' => true,
			'default' => NULL
		),
		'confaz_87' => array(
			'type' => 'boolean',
			'null' => true,
			'default' => NULL
		),
		'analise_recursal' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL
		),
		'farmacia_popular' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL
		),
		'apresentacao_reduzida' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL
		),
		'formas_farmaceuticas_solidas' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL
		),
		'formas_farmaceuticas_liquidas' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL
		),
		'formas_farmaceuticas_semisolidas' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL
		),
		'formas_farmaceuticas_gasosas' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL
		),
		'vias_de_administracao' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL
		),
		'embalagens_primarias' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL
		),
		'embalagens_secundarias' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL
		),
		'acessorios' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL
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
			'index_codigo' => array(
				'column' => 'codigo',
				'unique' => 0,
			),
			'index_principio_ativo' => array(
				'column' => 'principio_ativo',
				'unique' => 0,
			),
			'index_laboratorio' => array(
				'column' => 'laboratorio',
				'unique' => 0,
			),
			'index_codigo_ggrem' => array(
				'column' => 'codigo_ggrem',
				'unique' => 0,
			),
			'index_nome' => array(
				'column' => 'nome',
				'unique' => 0,
			),
			'index_classe_terapeutica' => array(
				'column' => 'classe_terapeutica',
				'unique' => 0,
			),
		),
		'tableParameters' => array(
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci',
			'engine' => 'MyISAM'
		)
	);
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
		'escolaridade' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 128,
		),
		'escolaridade_ano' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 4,
		),
		'instituicao' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 128,
		),
		'instituicao_cidade' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 128,
		),
		'instituicao_estado' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 8,
		),
		'estado_civil' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 64
		),
		'especialidade' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 128,
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
			),
			'index_nome' => array(
				'column' => 'nome',
				'unique' => 0,
			),
		),
		'tableParameters' => array(
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci',
			'engine' => 'MyISAM'
		)
	);
	var $receitas = array(
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
		'medicamento_id' => array(
			'type' => 'integer',
			'null' => false,
			'default' => NULL,
			'key' => 'index'
		),
		'nome' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
		),
		'inicio' => array(
			'type' => 'date',
			'null' => false,
			'default' => NULL,
		),
		'termino' => array(
			'type' => 'date',
			'null' => false,
			'default' => NULL,
		),
		'dosagem' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
		),
		'periodicidade' => array(
			'type' => 'string',
			'null' => false,
			'default' => NULL,
		),
		'observacoes' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
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
			'fk_receitas_pessoas' => array(
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
		'requerimento_senha' => array(
			'type' => 'datetime',
			'null' => true,
			'default' => NULL,
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
