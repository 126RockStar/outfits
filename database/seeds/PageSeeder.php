<?php

use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   //check if table is empty
        if(empty(DB::table('pages')->where('name','faq')->first())){
            DB::table('pages')->insert([
                'name' => 'faq',
                'details' => 'this is faq page',
            ]);
        }

        if(empty(DB::table('pages')->where('name','terms')->first())){
            DB::table('pages')->insert([
                'name' => 'terms',
                'details' => 'this is term page',
            ]);
        }
    }
}
