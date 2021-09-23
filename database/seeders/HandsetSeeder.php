<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Handset;

class HandsetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $data=array(
            array("handset_type"=>"Mobile phone"),
            array("handset_type"=>"Desk phone"),
            array("handset_type"=>"Software phone"),
           
        );
        Handset::insert($data);
    }
}
