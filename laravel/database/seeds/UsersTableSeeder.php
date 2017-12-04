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
            'name' => "Edward Pol",
            'email' => "edpol@p4bh.org",
            'password' => bcrypt('ilE2012!'),
            'created_at' => now(),
            'updated_at' => now(),
            'is_admin' => true
        ]);
    }
}
