<?php

use Illuminate\Database\Seeder;

class UserTradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_trades')->truncate();

        $user_trades = array(
            array(
                'user_id' => 1,
                'trade_id' => 1,
                'user_position' => 15,
                'risk' => 0.2
            ),
            array(
                'user_id' => 1,
                'trade_id' => 3,
                'user_position' => 167,
                'risk' => 1
            ),
            array(
                'user_id' => 2,
                'trade_id' => 2,
                'user_position' => 108,
                'risk' => 0.7
            ),
            array(
                'user_id' => 3,
                'trade_id' => 1,
                'user_position' => 87,
                'risk' => 0.9
            ),
            array(
                'user_id' => 3,
                'trade_id' => 2,
                'user_position' => 204,
                'risk' => 0.1
            ),
            array(
                'user_id' => 3,
                'trade_id' => 3,
                'user_position' => 50,
                'risk' => 0.4
            )
        );

        DB::table('user_trades')->insert($user_trades);
    }
}
