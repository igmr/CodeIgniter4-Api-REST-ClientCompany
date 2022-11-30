<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitSeed extends Seeder
{
	public function run()
	{
		$this->call('companySeed');
		$this->call('clientSeed');
	}
}
