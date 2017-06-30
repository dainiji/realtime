<?php

use Illuminate\Database\Seeder;
use App\User;

class userListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $role_author	 = 3; //Role::where("name","Member")->first();
        //
        $author = new User();
        $author->name     = "Daini";
        $author->first_name 	= "Daini";
        $author->last_name 	= "Author";
        $author->email 		= "daini@example.com";
        $author->password 	= bcrypt('daini');
        $author->save();
        $author->roles()->attach($role_author);

        $author = new User();
        $author->name     = "Vikas";
        $author->first_name 	= "Vikas";
        $author->last_name 	= "Author";
        $author->email 		= "vikas@example.com";
        $author->password 	= bcrypt('vikas');
        $author->save();
        $author->roles()->attach($role_author);

        $author = new User();
        $author->name         = "Amit";
        $author->first_name   = "Amit";
        $author->last_name 	= "Author";
        $author->email 		= "amit@example.com";
        $author->password 	= bcrypt('amit');
        $author->save();
        $author->roles()->attach($role_author);
        
        $author = new User();
        $author->name           = "Gaurav";
        $author->first_name     = "Gaurav";
        $author->last_name 	    = "Author";
        $author->email 		    = "gaurav@example.com";
        $author->password 	    = bcrypt('gaurav');
        $author->save();
        $author->roles()->attach($role_author);

    }
}
