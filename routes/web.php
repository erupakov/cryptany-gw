<?php
/**
 * Application Routes
 * PHP Version 7
 *
 * @category Infrastructure
 * @package  App
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
use App\Transaction;
use App\Wallet;
use App\User;
use App\Mail\TransactionCreated;
use Illuminate\Support\Facades\Mail;

$router->get(
    '/', 
    function () use ($router) {
        return 'Cryptany.io API v1 root';
    }
);

$router->get('/txs/check/{hash}', 'EthController@getTxStatus');
$router->post('/txs/check', 'EthController@getTxStatus');
$router->post('/txs/checkAddress', 'EthController@getTxStatusByAddress');
$router->get('/txs/all', 'TxController@getAll');
$router->post('/txs/all', 'TxController@getAll');
$router->get('/txs/one/{id}', 'TxController@getTransactionWithId');
$router->post('/txs/one', 'TxController@getTransaction');
$router->delete('/txs/one', 'TxController@deleteTransaction');
$router->post('/txs/status', 'TxController@changeTxStatus');
$router->post('/txs/new', 'TxController@createNewTransaction');
$router->get('/txs/test/{hash}', 'TxController@testBroadcast');
$router->post('/eth/hook/txstat', 'EthController@getTxStatusHook');
$router->post('/user/signin', 'UserController@processSignIn');
$router->post('/user/verifycode', 'UserController@processVerifyCode');
$router->post('/user/signup', 'UserController@processSignUp');
$router->post('/user/resetpwd', 'UserController@processResetPassword');
$router->post('/data/rate', 'DataController@getRates');

// TODO: EthController is temporary, should do it in DataController
$router->get('/data/addr', 'EthController@getTransientAddress');

// TODO: EthController is temporary, should do it in DataController
$router->post('/data/addr', 'EthController@getTransientAddress');

$router->get(
    '/testmail', function () {
        $tx = App\Transaction::findOrFail(2);

        Mail::to('eugene.rupakov@gmail.com')
			->queue(new TransactionCreated($tx)
            );
		return 'Mail sent';
    }
);