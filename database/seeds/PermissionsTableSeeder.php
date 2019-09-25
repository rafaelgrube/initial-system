<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Permission::updateOrCreate(
      ['name' => 'show-configs'],
      [
        'title' => 'Exibe Menu Configurações',
        'notes' => 'Menu para gereciamento de configurações'
      ]
    );
  }
}
