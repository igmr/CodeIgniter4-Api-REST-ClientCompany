<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;
class ClientSeed extends Seeder
{
	public function run()
	{
		$payload = [];
		for($i=0; $i<150; $i++)
		{
			$payload [] = $this->client();
		}
		//d($payload);
		$this->db->table('client')->insertBatch($payload);
	}
	public function client():array
	{
		$faker = Factory::create('es_ES');
		return [
			'company_id'	=>	$faker->numberBetween(1,50),
			'full_name'		=>	$faker->name(),
			'user_name'		=>	$faker->userName(),
			'phone'			=>	$faker->phoneNumber(),
			'email'			=>	$faker->freeEmail(),
			'currency_code'	=>	$faker->currencyCode(),
			'uuid'			=>	$faker->uuid(),
			'created_at'	=>	$faker->date(),
		];
	}
}
