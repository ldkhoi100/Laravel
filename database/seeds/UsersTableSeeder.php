<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Name 1';
        $user->username = 'ldkhoi97';
        $user->email = 'ldkhoi1@gmail.com';
        $user->password = bcrypt(123456789);
        $user->save();

        $user = new User();
        $user->name = 'Name 2';
        $user->username = 'ldkhoi98';
        $user->email = 'ldkhoi2@gmail.com';
        $user->password = bcrypt(123456789);
        $user->save();

        $user = new User();
        $user->name = 'Name 3';
        $user->username = 'ldkhoi99';
        $user->email = 'ldkhoi3@gmail.com';
        $user->password = bcrypt(123456789);
        $user->save();
    }
}