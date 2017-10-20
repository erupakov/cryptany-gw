<?php

namespace App\Listeners;

use App\Events\ExampleEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExampleListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //{
  "block_height": -1,
  "block_index": 0,
  "hash": "27641f8bbbd3ccb0fb4c03b898890061d1f7e81842d2549b0f0b7ebe9024056c",
  "addresses": [
    "1df7d1a84cf6d9893bf7f62bd00ae6d51085d6e9",
    "1f7ad12b17f817a213d2632e9f247ca10cf4033f"
  ],
  "total": 100000000000000,
  "fees": 441000000000000,
  "size": 108,
  "gas_limit": 21000,
  "gas_price": 21000000000,
  "received": "2017-10-02T17:09:48.35Z",
  "ver": 0,
  "double_spend": false,
  "vin_sz": 1,
  "vout_sz": 1,
  "confirmations": 0,
  "inputs": [
    {
      "sequence": 0,
      "addresses": [
        "1df7d1a84cf6d9893bf7f62bd00ae6d51085d6e9"
      ]
    }
  ],
  "outputs": [
    {
      "value": 100000000000000,
      "addresses": [
        "1f7ad12b17f817a213d2632e9f247ca10cf4033f"
      ]
    }
  ]
}
    }

    /**
     * Handle the event.
     *
     * @param  ExampleEvent  $event
     * @return void
     */
    public function handle(ExampleEvent $event)
    {
        //
    }
}
