<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role_admin = new Role();
        $role_admin->name = 'Admin';
        $role_admin->description = 'An Admin';
        $role_admin->save();

        $role_admin = new Role();
        $role_admin->name = 'Manager';
        $role_admin->description = 'A Manager member with extra permission';
        $role_admin->save();

        $user_author = new Role();
        $user_author->name = 'Member';
        $user_author->description = 'A member user';
        $user_author->save();

        $role_user = new Role();
        $role_user->name = 'User';
        $role_user->description = 'A Simple User';
        $role_user->save();
        
        

        
    }
}
