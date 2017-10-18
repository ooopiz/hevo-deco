<?php

use App\Eloquent\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            ['name'=>'admin', 'email'=>'admin@xxx.com', 'password'=>bcrypt('admin'), 'created_at'=> DB::raw('CURRENT_TIMESTAMP'), 'updated_at'=> DB::raw('CURRENT_TIMESTAMP')],
        );
        User::insert($data);
    }
}
