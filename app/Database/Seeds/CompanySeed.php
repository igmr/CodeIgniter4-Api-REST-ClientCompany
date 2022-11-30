<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class CompanySeed extends Seeder
{
	public function run()
	{
		$payload = [];
		for($i=0; $i<50; $i++)
		{
			$payload [] = $this->company();
		}
		//d($payload);
		$this->db->table('company')->insertBatch($payload);
	}

	private function company():array
	{
		$faker = Factory::create('es_ES');
		return [
			'name'			=>	$faker->catchPhrase(),
			'uuid'			=>	$faker->uuid(),
			'state'			=>	$faker->state(),
			'country'		=>	$faker->country(),
			'city'			=>	$faker->city(),
			'street'		=>	$faker->streetName(),
			'number'		=>	$faker->buildingNumber(),
			'postcode'		=>	$faker->postcode(),
			'created_at'	=>	$faker->date(),
		];
	}
}
