<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Company extends Entity
{
	protected $datamap	=	[];
	protected $dates	=	['created_at', 'updated_at', 'deleted_at'];
	protected $casts	=	[
		'id'			=>	'integer',
		'name'			=>	'string',
		'uuid'			=>	'string',
		'state'			=>	'string',
		'country'		=>	'string',
		'city'			=>	'string',
		'street'		=>	'string',
		'number'		=>	'string',
		'postcode'		=>	'string',
		'created_at'	=>	'timestamp',
		'updated_at'	=>	'?timestamp',
		'deleted_at	'	=>	'?timestamp',
	];
	//*	---------------------------------------------------------------------------
	//!	Setters
	//*	---------------------------------------------------------------------------
	public function setCreatedAt(string $createdAt)
	{
		$this->attributes['created_at'] = new Time($createdAt, 'UTC');
		return $this;
	}
	public function setUpdatedAt(string $updatedAt)
	{
		$this->attributes['updated_at'] = new Time($updatedAt, 'UTC');
		return $this;
	}
	public function setDeletedAt(string $deletedAt)
	{
		$this->attributes['updated_at'] = new Time($deletedAt, 'UTC');
		return $this;
	}
}
