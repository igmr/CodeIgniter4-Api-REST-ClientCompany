<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\DataBase\RawSql;
class AddTableClient extends Migration
{
	//*	---------------------------------------------------------------------------
	//!	Migrate
	//*	---------------------------------------------------------------------------
	public function up()
	{
		//*	Definición de campos
		$fields = [
			'id'			=>	[
				'type'				=>	'INT',
				'constraint'		=>	15,
				'unique'			=>	true,
				'null'				=>	false,
				//'default'			=>	0,
				'auto_increment'	=>	true,
			],
			'company_id'	=>	[
				'type'				=>	'INT',
				'constraint'		=>	15,
				'unique'			=>	false,
				'null'				=>	false,
				'default'			=>	0,
				'auto_increment'	=>	false,
			],
			'full_name'		=>	[
				'type'				=>	'VARCHAR',
				'constraint'		=>	86,
				'unique'			=>	false,
				'null'				=>	false,
				'default'			=>	'',
				'auto_increment'	=>	false,
			],
			'user_name'		=>	[
				'type'				=>	'VARCHAR',
				'constraint'		=>	65,
				'unique'			=>	false,
				'null'				=>	false,
				'default'			=>	'',
				'auto_increment'	=>	false,
			],
			'phone'			=>	[
				'type'				=>	'VARCHAR',
				'constraint'		=>	65,
				'unique'			=>	true,
				'null'				=>	false,
				'default'			=>	'',
				'auto_increment'	=>	false,
			],
			'email'			=>	[
				'type'				=>	'VARCHAR',
				'constraint'		=>	65,
				'unique'			=>	true,
				'null'				=>	false,
				'default'			=>	'',
				'auto_increment'	=>	false,
			],
			'currency_code'	=>	[
				'type'				=>	'VARCHAR',
				'constraint'		=>	10,
				'unique'			=>	false,
				'null'				=>	false,
				'default'			=>	'',
				'auto_increment'	=>	false,
			],
			'uuid'			=>	[
				'type'				=>	'VARCHAR',
				'constraint'		=>	65,
				'unique'			=>	false,
				'null'				=>	false,
				'default'			=>	'',
				'auto_increment'	=>	false,
			],
			'created_at'	=>	[
				'type'				=>	'TIMESTAMP',
				//'constraint'		=>	15,
				'unique'			=>	false,
				'null'				=>	false,
				'default'			=>	new RawSql('CURRENT_TIMESTAMP'),
				'comment'			=>	'',
				'auto_increment'	=>	false,
			],
			'updated_at'	=>	[
				'type'				=>	'TIMESTAMP',
				//'constraint'		=>	15,
				'unique'			=>	false,
				'null'				=>	true,
				'default'			=>	null,
				'comment'			=>	'',
				'auto_increment'	=>	false,
			],
			'deleted_at'	=>	[
				
				'type'				=>	'TIMESTAMP',
				//'constraint'		=>	15,
				'unique'			=>	false,
				'null'				=>	true,
				'default'			=>	null,
				'comment'			=>	'',
				'auto_increment'	=>	false,
			],
		];
		//*	Agregar campos
		$this->forge->addField($fields);
		//*	Definición de clave primaria
		$this->forge->addPrimaryKey('id');
		$this->forge->addForeignKey('company_id', 'company', 'id');
		//*	Agregar atributos adicionales
		$attributes = ['ENGINE', 'InnoDB'];
		//* Crear tabla
		$this->forge->createTable('client', true, $attributes);
	}
	//*	---------------------------------------------------------------------------
	//!	Rollback
	//*	---------------------------------------------------------------------------
	public function down()
	{
		$this->forge->dropTable('client');
	}
}
