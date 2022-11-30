<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use App\Controllers\BaseController;
use App\Models\CompanyModel;
use App\Entities\Company;

class CompanyController extends BaseController
{
	//*	---------------------------------------------------------------------------
	//!	General
	//*	---------------------------------------------------------------------------
	protected $companyModel;
	public function __construct()
	{
		$this->companyModel = new CompanyModel();
	}
	//*	---------------------------------------------------------------------------
	//!	Métodos HTTP
	//*	---------------------------------------------------------------------------
	public function index()
	{
		try {
			$data = $this->findAllCompany()?:null;
			if(is_null($data))
			{
				return $this->respond([]);
			}
			return $this->respond($data);
		} catch (Exception $e) {
			return $this->failServerError($e->getMessage());
		}
	}
	public function show(int $company_id)
	{
		try {
			if(!is_numeric($company_id))
			{
				return $this->fail('Valor de parámetro es inválido');
			}
			$data = $this->findCompanyById($company_id)?:null;
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
			$data = $this->findOnlyDeletedCompany()?:null;
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
			$company = new Company((array) $req);
			$company->uuid = uniqid();
			return $this->add($company);
		} catch (Exception $e) {
			return $this->failServerError($e->getMessage());
		}
	}
	public function edit(int $company_id)
	{
		try {
			if(!is_numeric($company_id))
			{
				return $this->fail('Valor de parámetro es inválido');
			}
			$valid = $this->verifyDataEdit($this->request, $company_id);
			if(!is_null($valid))
			{
				return $this->fail($valid);
			}
			$req = $this->request->getVar();
			$company = new Company((array) $req);
			return $this->update($company_id, $company);
		} catch (Exception $e) {
			return $this->failServerError($e->getMessage());
		}
	}
	public function remove(int $company_id)
	{
		try {
			if(!\is_numeric($company_id))
			{
				return $this->fail('Valor de parámetro es inválido');
			}
			$removed = $this->companyModel->delete($company_id);
			return $this->respond(['id'=>$company_id]);
		} catch (\Exception $e) {
			return $this->failServerError($e->getMessage());
		}
	}
	//*	---------------------------------------------------------------------------
	//!	Métodos SQL
	//*	---------------------------------------------------------------------------
	private function findAllCompany()
	{
		return $this->companyModel
			->select(['id','name','uuid','state','country','city'
				,'street','number','postcode',])
			->findAll();
	}
	private function findCompanyById(string $Company_id)
	{
		return $this->companyModel
			->select(['id','name','uuid','state','country','city'
				,'street','number','postcode',])
			->where('id', $Company_id)
			->first();
	}
	private function findOnlyDeletedCompany()
	{
		return $this->companyModel
			->select(['id','name','uuid','state','country','city'
				,'street','number','postcode',])
			->onlyDeleted()
			->findAll();
	}
	private function add(Company $data)
	{
		$created = $this->companyModel->insert($data);
		if($created=== false)
		{
			return $this->fail($this->companyModel->errors());
		}
		return $this->respondCreated(['id'=> $created]);
	}
	private function update(int $company_id, Company $data)
	{
		$updated = $this->companyModel->update($company_id, $data);
		if($updated === false)
		{
			return $this->fail($this->companyModel->errors());
		}
		return $this->respond([['id'=> $company_id]]);
	}
	//*	---------------------------------------------------------------------------
	//!	Métodos validaciones
	//*	---------------------------------------------------------------------------
	private function verifyDataStore(RequestInterface $req)
	{
		$validation = \Config\Services::validation();
		$rules	= 	[
			'name'	=>	[
				'label'		=>	'name',
				'rules'		=>	'required|is_unique[company.name]',
				'errors'	=>	[
					'required' => 'Es requerido.',
					'is_unique'	=>	'Información duplicado.'
				],
			],
			'state'		=>	[
				'label'		=> 'state',
				'rules'		=> 'required',
				'errors'	=> [
					'required' => 'Es requerido.',
				],
			],
			'country'		=>	[
				'label'		=> 'country',
				'rules'		=> 'required',
				'errors'	=> [
					'required' => 'Es requerido.',
				],
			],
			'city'		=>	[
				'label'		=> 'city',
				'rules'		=> 'required',
				'errors'	=> [
					'required' => 'Es requerido.',
				],
			],
			'street'		=>	[
				'label'		=> 'street',
				'rules'		=> 'required',
				'errors'	=> [
					'required' => 'Es requerido.',
				],
			],
			'number'		=>	[
				'label'		=> 'number',
				'rules'		=> 'required',
				'errors'	=> [
					'required' => 'Es requerido.',
				],
			],
			'postcode'		=>	[
				'label'		=> 'postcode',
				'rules'		=> 'required',
				'errors'	=> [
					'required' => 'Es requerido.',
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
	private function verifyDataEdit(RequestInterface $req, int $company_id)
	{
		$validation = \Config\Services::validation();
		$rules	= 	[
			'name'	=>	[
				'label'		=>	'name',
				'rules'		=>	'is_unique[company.name,id,'.$company_id.']',
				'errors'	=>	[
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
}
