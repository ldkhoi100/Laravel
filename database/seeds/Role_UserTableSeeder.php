<?php

use App\Role_User;
use Illuminate\Database\Seeder;

class Role_UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = new Role_User();
        $role_user->role_id = 1;
        $role_user->user_id = 1;
        $role_user->save();

        $role_user = new Role_User();
        $role_user->role_id = 2;
        $role_user->user_id = 2;
        $role_user->save();
    }
}