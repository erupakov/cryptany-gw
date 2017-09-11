<?php

use Illuminate\Database\Seeder;
use App\Currency;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// Create 20 test users
        factory(App\User::class, 20)
        	->create();
		// Create 12 test API users
        factory(App\APIUser::class, 12)
        	->create();
		// Create currencies
		$this->create_currency( 'USD', 'USA Dollar' );
		$this->create_currency( 'BTC', 'Bitcoin' );
		$this->create_currency( 'LTC', 'Litecoin' );
		$this->create_currency( 'ETH', 'Ethereum' );
		$this->create_currency( 'WVS', 'WavesCoin' );
    }

	private function create_currency( $symbol, $description )
	{
		$c = new Currency;
		$c->symbol = $symbol;
		$c->description = $description;
		$c->save();
	}
}
