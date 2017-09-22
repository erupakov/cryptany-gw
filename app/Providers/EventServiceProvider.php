<?php
/**
 * Our Event service provider
 * PHP Version 7
 *
 * @category ServiceProvider
 * @package  App\Providers
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
namespace App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

/**
 * Our Event service provider
 *
 * @category ServiceProvider
 * @package  App\Providers
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\TransactionCreatedEvent' => [
            'App\Listeners\TransactionListener',
        ]
    ];
}
