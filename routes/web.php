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

$router->get(
    '/', 
    function () use ($router) {
        return $router->app->version();
    }
);

$router->get('/txs/check/{hash}', 'EthController@getTxStatus');
$router->post('/txs/check', 'EthController@getTxStatus');
$router->get('/txs/checkAddress', 'EthController@getTxStatusByAddress');
$router->post('/txs/all', 'TxController@getAll');
$router->post('/txs/one', 'TxController@getTransaction');
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
