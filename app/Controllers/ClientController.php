<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use App\Controllers\BaseController;
use App\Models\ClientModel;
use App\Entities\Client;


class ClientController extends BaseController
{
	//*	---------------------------------------------------------------------------
	//!	General
	//*	---------------------------------------------------------------------------
	protected $clientModel;
	public function __construct()
	{
		$this->clientModel = new ClientModel();
	}
	//*	---------------------------------------------------------------------------
	//!	Métodos HTTP
	//*	---------------------------------------------------------------------------
	public function index()
	{
		try {
			$data = $this->findAllClient()?:null;
			if(is_null($data))
			{
				return $this->respond([]);
			}
			return $this->respond($data);
		} catch (Exception $e) {
			return $this->failServerError($e->getMessage());
		}
	}
	public function show(int $client_id)
	{
		try {
			if(!is_numeric($client_id))
			{
				return $this->fail('Valor de parámetro es inválido');
			}
			$data = $this->findClientById($client_id)?:null;
			if(is_null($data))
			{
				return $this->respond([]);
			}
			return $this->respond($data);
		} catch (Exception $e) {
			return $this->failServerError($e->getMessage());
		}
	}
	public function deleted()
	{
		try {
			$data = $this->findOnlyDeletedClient()?:null;
			if(is_null($data))
			{
				return $this->respond([]);
			}
			return $this->respond($data);
		} catch (Exception $e) {
			return $this->failServerError($e->getMessage());
		}
	}
	public function store()
	{
		try {
			$valid = $this->verifyDataStore($this->request);
			if(!is_null($valid))
			{
				return $this->fail($valid);
			}
			$req = $this->request->getVar();
			$client = new Client((array) $req);
			$client->uuid = uniqid();
			return $this->add($client);
		} catch (Exception $e) {
			return $this->failServerError($e->getMessage());
		}
	}
	public function edit(int $client_id)
	{
		try {
			if(!is_numeric($client_id))
			{
				return $this->fail('Valor de parámetro es inválido');
			}
			$valid = $this->verifyDataEdit($this->request, $client_id);
			if(!is_null($valid))
			{
				return $this->fail($valid);
			}
			$req = $this->request->getVar();
			$client = new Client((array) $req);
			return $this->update($client_id,$client);
		} catch (Exception $e) {
			return $this->failServerError($e->getMessage());
		}
	}
	public function remove(int $client_id)
	{
		try {
			if(!\is_numeric($client_id))
			{
				return $this->fail('Valor de parámetro es inválido');
			}
			$removed = $this->clientModel->delete($client_id);
			if(!$removed)
			{
				throw new Exception('Algo salio mal');
			}
			return $this->respond(['id' =>$client_id ]);
		} catch (\Exception $e) {
			return $this->failServerError($e->getMessage());
		}
	}
	//*	---------------------------------------------------------------------------
	//!	Métodos SQL
	//*	---------------------------------------------------------------------------
	private function findAllClient()
	{
		return $this->clientModel
			->select(['id','company_id AS company','full_name AS name','user_name AS user',
				'phone','email','currency_code AS current','uuid',])
			->findAll();
	}
	private function findClientById(string $client_id)
	{
		return $this->clientModel
			->select(['id','company_id AS company','full_name AS name','user_name AS user',
				'phone','email','currency_code AS current','uuid',])
			->where('id', $client_id)
			->first();
	}
	private function findOnlyDeletedClient()
	{
		return $this->clientModel
			->select(['id','company_id AS company','full_name AS name','user_name AS user',
				'phone','email','currency_code AS current','uuid',])
			->onlyDeleted()
			->findAll();
	}
	private function add(Client $data)
	{
		$created = $this->clientModel->insert($data);
		if($created=== false)
		{
			return $this->getResponseError($this->clientModel->errors()
				, 'Error al crear cliente');
		}
		return $this->respondCreated(["id"=>$created]);
	}
	private function update(int $client_id, Client $data)
	{
		$updated = $this->clientModel->update($client_id, $data);
		if($updated === false)
		{
			$this->fail($this->clientModel->errors());
		}
		return $this->respond(['id'=> $client_id]);
	}
	//*	---------------------------------------------------------------------------
	//!	Métodos validaciones
	//*	---------------------------------------------------------------------------
	private function verifyDataStore(RequestInterface $req)
	{
		$validation = \Config\Services::validation();
		$rules	= 	[
			'user_name'	=>	[
				'label'		=>	'user_name',
				'rules'		=>	'required|is_unique[client.user_name]',
				'errors'	=>	[
					'required' => 'Es requerido',
					'is_unique'	=>	'Información duplicado.'
				],
			],
			'phone'		=>	[
				'label'		=> 'phone',
				'rules'		=> 'required|is_unique[client.phone]',
				'errors'	=> [
					'required' => 'Es requerido',
					'is_unique'	=>	'Información duplicado.'
				],
			],
			'email'		=>	[
				'label'		=> 'email',
				'rules'		=> 'required|is_unique[client.email]',
				'errors'	=> [
					'required' => 'Es requerido',
					'is_unique'	=>	'Información duplicado.'
				],
			],
		];
		$validation->setRules($rules);
		$validated = $validation->withRequest($req)->run();
		if($validated === false)
		{
			return $validation->getErrors();
		}
		return null;
	}
	private function verifyDataEdit(RequestInterface $req, int $client_id)
	{
		$validation = \Config\Services::validation();
		$rules	= 	[
			'user_name'	=>	[
				'label'		=>	'user_name',
				'rules'		=>	'is_unique[client.user_name,id,'.$client_id.']',
				'errors'	=>	[
					'is_unique'	=>	'Información duplicado.'
				],
			],
			'phone'		=>	[
				'label'		=> 'phone',
				'rules'		=> 'is_unique[client.phone,id,'.$client_id.']',
				'errors'	=> [
					'is_unique'	=>	'Información duplicado.'
				],
			],
			'email'		=>	[
				'label'		=> 'email',
				'rules'		=> 'valid_email|is_unique[client.email,id,'.$client_id.']',
				'errors'	=> [
					'valid_email'	=>	'Formato inválido.',
					'is_unique'		=>	'Información duplicado.',
				],
			],
		];
		$validation->setRules($rules);
		$validated = $validation->withRequest($req)->run();
		if($validated === false)
		{
			return $validation->getErrors();
		}
		return null;
	}
}
