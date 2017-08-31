<?php

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::create([
			'name' => 'Student Test',
			'email' => 'student@gmail.com',
			'password' => bcrypt('abcd'),
			'phone' => '',
			'id_number' => '',
			'admin' => 0
		]);

		User::create([
			'name' => 'Staff Test',
			'email' => 'staff@gmail.com',
			'password' => bcrypt('abcd'),
			'phone' => '',
			'id_number' => '',
			'admin' => 1
		]);
	}
}
