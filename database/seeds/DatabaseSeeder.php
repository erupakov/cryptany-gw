<?php

use Illuminate\Database\Seeder;
use App\Currency;
use App\APIUser;
use \Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// Create test API user for mobile
		$apiu = new APIUser;
		$apiu->appToken = 'n45qDLLOi8';
		$apiu->username = 'android';
		$apiu->description = 'test mobile api user';
		$apiu->expiryDate = Carbon::now()->addYear();
		$apiu->isActive = true;
		$apiu->useTestChain = true;
		$apiu->save();

		// Create test API user for chat
		$apiu = new APIUser;
		$apiu->appToken = 'RyQJis90Cp';
		$apiu->username = 'magento-chat';
		$apiu->description = 'test chat api user';
		$apiu->expiryDate = Carbon::now()->addYear();
		$apiu->isActive = true;
		$apiu->useTestChain = true;
		$apiu->save();

		// Create test API user for chat
		$apiu = new APIUser;
		$apiu->appToken = 'GlTAohP33j';
		$apiu->username = 'button';
		$apiu->description = 'buy now button api user';
		$apiu->expiryDate = Carbon::now()->addYear();
		$apiu->isActive = true;
		$apiu->useTestChain = true;
		$apiu->save();

		// Create test API user for magento user
		$apiu = new APIUser;
		$apiu->appToken = '8XgtiEGJI2';
		$apiu->username = 'magento84237';
		$apiu->description = 'magento 1.x payment plugin';
		$apiu->expiryDate = Carbon::now()->addYear();
		$apiu->isActive = true;
		$apiu->useTestChain = true;
		$apiu->save();

		// Create 20 test users
        factory(App\User::class, 20)
        	->create();
		// Create 12 more test API users
        factory(App\APIUser::class, 10)
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
