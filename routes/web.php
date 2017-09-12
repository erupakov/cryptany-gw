<?php

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/txs/check/{hash}', 'EthController@getTxStatus');
$router->post('/txs/check', 'EthController@getTxStatus');
$router->post('/txs/all', 'TxController@getAll');
$router->post('/txs/one', 'TxController@getTransaction');
$router->post('/txs/new', 'TxController@createNewTransaction');
$router->post('/eth/hook/txstat', 'EthController@getTxStatusHook');
$router->post('/user/signin', 'UserController@processSignIn');
$router->post('/user/verifycode', 'UserController@processVerifyCode');
$router->post('/user/signup', 'UserController@processSignUp');
$router->post('/user/resetpwd', 'UserController@processResetPassword');
$router->post('/data/rate', 'DataController@getRates');
$router->get('/data/addr', 'EthController@getTransientAddress');
$router->post('/data/addr', 'EthController@getTransientAddress');
