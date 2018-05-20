<?php

use Illuminate\Database\Seeder;
use App\Usuario;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$users = array(['nombre' => 'Marce ', 
    					 'apellido' => 'Alvarez',
    					 'email' => 'marcela@asistencia.com', 
    					 'password' => Hash::make('123'),
    					 'permiso' => 1,
    					 'estado' => 1]);

    	 foreach ($users as $user) { 
    	 	Usuario::create($user); 
    	 }
    }
}
