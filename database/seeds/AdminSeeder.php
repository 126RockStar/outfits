<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //check if table is empty
        if(empty(DB::table('users')->where('type','admin')->first())){
            DB::table('users')->insert([
                // 'name' => 'Super Admin',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => date('Y-m-d h:m:s'),
                'password' => '$2y$10$L3sF.MVQ3.lIYaIGq3GIkurCuJmpGa3HkavSCBMZVOa2laa.z4n1m',
                'type' => 'admin'
            ]);
        }
    }
}
