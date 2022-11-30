<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
	//*	---------------------------------------------------------------------------
	//!	General
	//*	---------------------------------------------------------------------------
	protected $DBGroup				=	'default';
	protected $table				=	'client';
	protected $primaryKey			=	'id';
	protected $useAutoIncrement		=	true;
	protected $insertID				=	0;
	protected $returnType			=	'array';
	protected $useSoftDeletes		=	true;
	protected $protectFields		=	true;
	protected $allowedFields		=	['company_id','full_name','user_name','phone'
		,'email','currency_code','uuid',];

	//*	---------------------------------------------------------------------------
	//!	Dates
	//*	---------------------------------------------------------------------------
	protected $useTimestamps		=	true;
	protected $dateFormat			=	'datetime';
	protected $createdField			=	'created_at';
	protected $updatedField			=	'updated_at';
	protected $deletedField			=	'deleted_at';

	//*	---------------------------------------------------------------------------
	//!	Validation
	//*	---------------------------------------------------------------------------
	protected $validationRules		=	[];
	protected $validationMessages		=	[];
	/*protected $validationRules		=	[
		'user_name'	=>	'required|is_unique[client.user_name,cliente_id,{id}]',
		'phone'		=>	'required|is_unique[client.phone,cliente_id,{id}]',
		'email'		=>	'required|is_unique[client.email,cliente_id,{id}]',
	];
	protected $validationMessages	=	[
		'user_name'	=>	[
							'required'	=>	'Es requerido.',
							'is_unique'	=>	'Información duplicada.',
						],
		'phone'		=>	[
							'required'	=>	'Es requerido.',
							'is_unique'	=>	'Información duplicada.',
						],
		'email'		=>	[
							'required'	=>	'Es requerido.',
							'is_unique'	=>	'Información duplicada.',
						],
	];
	*/
	protected $skipValidation		=	false;
	protected $cleanValidationRules	=	true;

	//*	---------------------------------------------------------------------------
	//!	Callbacks
	//*	---------------------------------------------------------------------------
	protected $allowCallbacks		=	true;
	protected $beforeInsert			=	[];
	protected $afterInsert			=	[];
	protected $beforeUpdate			=	[];
	protected $afterUpdate			=	[];
	protected $beforeFind			=	[];
	protected $afterFind			=	[];
	protected $beforeDelete			=	[];
	protected $afterDelete			=	[];
}
