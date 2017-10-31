<?php

use App\Eloquent\Category;
use Illuminate\Database\Seeder;

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
            ['name' => 'Furniture | 家具', 'desc' => '', 'display' => 'Y'],
            ['name' => 'Lighting | 燈具', 'desc' => '', 'display' => 'Y'],
            ['name' => 'On the desk | 辦公用具', 'desc' => '', 'display' => 'Y'],
            ['name' => 'Home Acessory | 家飾配件', 'desc' => '', 'display' => 'Y'],
            ['name' => 'Odds and goods | 小物', 'desc' => '', 'display' => 'Y'],
            ['name' => 'Art Pieces | 定製品', 'desc' => '', 'display' => 'Y'],
        );
        Category::insert($data);
    }
}
