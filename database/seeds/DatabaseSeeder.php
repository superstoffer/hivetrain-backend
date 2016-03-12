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
        DB::statement("SET foreign_key_checks = 0");

        $this->call(UsersTableSeeder::class);
        $this->command->info('Users table seeded');

        $this->call(TradesTableSeeder::class);
        $this->command->info('Trades table seeded');

        $this->call(UserTradesTableSeeder::class);
        $this->command->info('UserTrades table seeded');
    }
}
