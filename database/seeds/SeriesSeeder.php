<?php

use App\Eloquent\Series;
use Illuminate\Database\Seeder;

class SeriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Series::truncate();
        $data = array(
            ['name' => 'F+ctory | 桌上的工廠', 'desc' => '', 'display' => 'Y'],
        );
        Series::insert($data);
    }
}
