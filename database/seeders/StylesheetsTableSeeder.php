<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StylesheetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('stylesheets')->delete();
        
        \DB::table('stylesheets')->insert(array (
            0 =>
            array (
                'id' => 8,
                'uri' => 'styles/CyanBug/',
                'name' => 'CyanBug',
                'addicode' => '',
                'designer' => 'jinglekang',
                'comment' => 'Based on BambooGreen',
            ),
        ));
        
        
    }
}