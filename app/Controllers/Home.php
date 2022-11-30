<?php

namespace App\Controllers;
use App\Models\ClientModel;
use App\Entities\Client;

class Home extends BaseController
{
	public function index()
	{
		try {
			$data = [
				'base_url'		=> 'https://ivangabino.com/apis/CodeIgniter4-Api-REST-ClientCompany/',
				'base_api'		=> 'https://ivangabino.com/apis/CodeIgniter4-Api-REST-ClientCompany/api/v1',
				'repositorio'	=> 'git clone git@github.com:igmr/CodeIgniter4-Api-REST-ClientCompany.git',
			];
			return $this->respond($data);
		} catch (Exception $e) {
			return $this->failServerError($e->getMessage());
		}
	}
	
}
