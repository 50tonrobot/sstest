<?php

use Illuminate\Database\Seeder;
use Illuminate\Hashing\BcryptHasher;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         DB::table('users')->insert([
             'name' => 'test',
             'email' => 'test@test.com',
             'password' => (new BcryptHasher)->make("YxeK32Xjl8Z"),
             'created_at' => '2015-10-12 02:40:15',
             'updated_at' => '2015-10-12 02:40:15'
         ]);
     }
}
