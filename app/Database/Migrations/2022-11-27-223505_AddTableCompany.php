<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\DataBase\RawSql;
class AddTableCompany extends Migration
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
			'name'			=>	[
				'type'				=>	'VARCHAR',
				'constraint'		=>	65,
				'unique'			=>	true,
				'null'				=>	false,
				'default'			=>	'',
				'auto_increment'	=>	false,
			],
			'uuid'			=>	[
				'type'				=>	'VARCHAR',
				'constraint'		=>	65,
				'unique'			=>	true,
				'null'				=>	false,
				'default'			=>	'',
				'auto_increment'	=>	false,
			],
			'state'			=>	[
				'type'				=>	'VARCHAR',
				'constraint'		=>	65,
				'unique'			=>	false,
				'null'				=>	false,
				'default'			=>	'',
				'auto_increment'	=>	false,
			],
			'country'		=>	[
				'type'				=>	'VARCHAR',
				'constraint'		=>	65,
				'unique'			=>	false,
				'null'				=>	false,
				'default'			=>	'',
				'auto_increment'	=>	false,
			],
			'city'			=>	[
				'type'				=>	'VARCHAR',
				'constraint'		=>	65,
				'unique'			=>	false,
				'null'				=>	false,
				'default'			=>	'',
				'auto_increment'	=>	false,
			],
			'street'		=>	[
				'type'				=>	'VARCHAR',
				'constraint'		=>	65,
				'unique'			=>	false,
				'null'				=>	false,
				'default'			=>	'',
				'auto_increment'	=>	false,
			],
			'number'		=>	[
				'type'				=>	'VARCHAR',
				'constraint'		=>	65,
				'unique'			=>	false,
				'null'				=>	false,
				'default'			=>	'',
				'auto_increment'	=>	false,
			],
			'postcode'		=>	[
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
				'unique'			=>	true,
				'null'				=>	true,
				'default'			=>	null,
				'comment'			=>	'',
				'auto_increment'	=>	false,
			],
			'deleted_at'	=>	[
				
				'type'				=>	'TIMESTAMP',
				//'constraint'		=>	15,
				'unique'			=>	true,
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
		//*	Agregar atributos adicionales
		$attributes = ['ENGINE', 'InnoDB'];
		//* Crear tabla
		$this->forge->createTable('company', true, $attributes);
	}
	//*	---------------------------------------------------------------------------
	//!	Rollback
	//*	---------------------------------------------------------------------------
	public function down()
	{
		$this->forge->dropTable('company');
	}
}
