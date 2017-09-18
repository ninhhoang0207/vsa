<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	$user = array(
    		'name'		=>	'Amin',
    		'email'		=>	'admin@admin.com',
    		'password'	=>	bcrypt('12345'),
    		'role'		=>	'admin',
            'is_active' =>  1,
    		);

    	User::create($user);
    	// DB::table('users')->insert([
     //        'name' => str_random(10),
     //        'email' => str_random(10).'@gmail.com',
     //        'password' => bcrypt('secret'),
     //    ]);
    }
}
