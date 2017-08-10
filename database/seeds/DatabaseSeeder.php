<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('system')->insert([
            'pay_left_time'=>15,
            'ground_left_time'=>7
        ]);
    }
}
