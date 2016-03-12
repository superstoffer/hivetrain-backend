<?php

use Illuminate\Database\Seeder;

class TradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trades')->truncate();

        $trades = array(
            array(
                'id' => 1,
                'open' => 'instrument',
                'close_price' => 50000,
                'close_time' => '2016-03-15',
                'pool_size' => 100,
                'owner_performance' => 0.2,
                'median_performance' => 0.5,
				'category' => 'healthcare'
            ),
            array(
				'id' => 2,
				'open' => 'instrument',
				'close_price' => 150000,
				'close_time' => '2016-03-18',
				'pool_size' => 250,
				'owner_performance' => 0.9,
				'median_performance' => 0.1,
				'category' => 'goods'
			),
            array(
				'id' => 3,
				'open' => 'instrument',
				'close_price' => 3000,
				'close_time' => '2016-03-10',
				'pool_size' => 50,
				'owner_performance' => 0.7,
				'median_performance' => 0.3,
				'category' => 'property'
			)
        );

        DB::table('trades')->insert($trades);
    }
}
