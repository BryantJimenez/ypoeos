<?php

use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$people = [
    		['id' => 1, 'name' => 'Nuevo', 'lastname' => 'Usuario', 'photo' => 'usuario.png', 'slug' => 'nuevo-usuario', 'email' => 'admin@gmail.com', 'password' => bcrypt('12345678'), 'state' => "1"]
    	];
    	DB::table('people')->insert($people);
    }
}
