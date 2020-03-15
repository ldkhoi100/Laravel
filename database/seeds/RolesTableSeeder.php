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
        $role = new Role();
        $role->name = 'ROLE_ADMIN';
        $role->description = 'Admin page';
        $role->save();

        $role = new Role();
        $role->name = 'ROLE_SUPERADMIN';
        $role->description = 'SUPERADMIN page';
        $role->save();
    }
}