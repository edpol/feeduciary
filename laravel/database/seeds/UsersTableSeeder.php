<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Administrator",
            'email' => "edpol@p4bh.org",
            'password' => bcrypt('lfdb4B$G_TWt'),
            'created_at' => now(),
            'updated_at' => now(),
            'admin' => true
        ]);
    }
}
