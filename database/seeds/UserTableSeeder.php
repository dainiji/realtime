<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	
        $role_admin      = Role::where("name","Admin")->first();
        $role_manager     = Role::where("name","Manager")->first();
    	$role_member	 = Role::where("name","Member")->first();
    	$role_user       = Role::where("name","User")->first();

        $admin = new User();
        $admin->name  = "Admin";
        $admin->first_name  = "Admin";
        $admin->last_name   = "User";
        $admin->email       = "admin@example.com";
        $admin->password    = bcrypt('admin');
        $admin->save();
        $admin->roles()->attach($role_admin);


        $manager = new User();
        $manager->name   = "Manager";
        $manager->first_name   = "Manager";
        $manager->last_name    = "User";
        $manager->email        = "manager@example.com";
        $manager->password     = bcrypt('manager');
        $manager->save();
        $manager->roles()->attach($role_manager);

        $author = new User();
        $author->name     = "Author";
        $author->first_name 	= "Author";
        $author->last_name 	= "User";
        $author->email 		= "author@example.com";
        $author->password 	= bcrypt('author');
        $author->save();
        $author->roles()->attach($role_member);
        
        $user = new User();
        $user->name   = "Visitor";
        $user->first_name   = "Visitor";
        $user->last_name    = "User";
        $user->email        = "visitor@example.com";
        $user->password     = bcrypt('visitor');
        $user->save();
        $user->roles()->attach($role_user);
        

    }
}
