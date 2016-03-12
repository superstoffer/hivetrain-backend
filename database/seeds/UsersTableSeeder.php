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
        DB::table('users')->truncate();

        $users = array(
            array(
               'id' => 1,
                'first_name' => 'Rob',
                'last_name' => 'Banks',
                'email' => 'rob@banks.com',
                'password' => bcrypt('1234'),
                'balance' => 25000
            ),
            array(
                'id' => 2,
                'first_name' => 'Forrest',
                'last_name' => 'Gump',
                'email' => 'forrest@gump.com',
                'password' => bcrypt('1234'),
                'balance' => 5000
            ),
            array(
                'id' => 3,
                'first_name' => 'Ben',
                'last_name' => 'Dover',
                'email' => 'ben@dover.com',
                'password' => bcrypt('1234'),
                'balance' => 155000
            )
        );

        DB::table('users')->insert($users);
    }
}
