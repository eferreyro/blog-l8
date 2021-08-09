<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'Emmanuel Ferreyro',
            'email' => 'admin@admin.com',
            'password' =>  bcrypt('12345678')
        ])->assignRole('Admin'); //Asigno el ROl admin al usuario creado
        User::factory(99)->create();
    }
}
