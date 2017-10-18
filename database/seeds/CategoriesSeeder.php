<?php

use App\Eloquent\Category;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        $data = array(
            ['name' => 'Furniture | 家具', 'desc' => '', 'display' => 'Y', 'active' => 'Y', 'delete' => 'N', 'created_at' => DB::raw('CURRENT_TIMESTAMP'), 'updated_at' => DB::raw('CURRENT_TIMESTAMP')],
            ['name' => 'Lighting | 燈具', 'desc' => '', 'display' => 'Y', 'active' => 'Y', 'delete' => 'N', 'created_at' => DB::raw('CURRENT_TIMESTAMP'), 'updated_at' => DB::raw('CURRENT_TIMESTAMP')],
            ['name' => 'On the desk | 辦公用具', 'desc' => '', 'display' => 'Y', 'active' => 'Y', 'delete' => 'N', 'created_at' => DB::raw('CURRENT_TIMESTAMP'), 'updated_at' => DB::raw('CURRENT_TIMESTAMP')],
            ['name' => 'Home Acessory | 家飾配件', 'desc' => '', 'display' => 'Y', 'active' => 'Y', 'delete' => 'N', 'created_at' => DB::raw('CURRENT_TIMESTAMP'), 'updated_at' => DB::raw('CURRENT_TIMESTAMP')],
            ['name' => 'Odds and goods | 小物', 'desc' => '', 'display' => 'Y', 'active' => 'Y', 'delete' => 'N', 'created_at' => DB::raw('CURRENT_TIMESTAMP'), 'updated_at' => DB::raw('CURRENT_TIMESTAMP')],
            ['name' => 'Art Pieces | 定製品', 'desc' => '', 'display' => 'Y', 'active' => 'Y', 'delete' => 'N', 'created_at' => DB::raw('CURRENT_TIMESTAMP'), 'updated_at' => DB::raw('CURRENT_TIMESTAMP')],
        );
        Category::insert($data);
    }
}
