<?php

use App\Eloquent\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $data = array(
            ['name'=>'Ricky', 'email'=>'r.huang850@gmail.com', 'password'=>bcrypt('admin'), 'remember_token' => ''],
            ['name'=>'admin', 'email'=>'admin', 'password'=>bcrypt('admin'), 'remember_token' => ''],
        );
        User::insert($data);
    }
}
