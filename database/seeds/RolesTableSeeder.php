<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrCreate(['id' => 1], ['name' => 'SuperAdmin']);
        Role::updateOrCreate(['id' => 2], ['name' => 'Administrador']);
        Role::updateOrCreate(['id' => 3], ['name' => 'Supervisor']);
        Role::updateOrCreate(['id' => 4], ['name' => 'Usuário']);
    }
}
