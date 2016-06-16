<?php
//路由
use Clovers\Route\Route;
$router = new Route();
Route::get('/', 'HomeController@index');
Route::get('user/{id}/comment/{comment_id}', function($id){
    var_dump($id);
});
Route::get('user/{id}/', 'UserController@show');
Route::get('test/sql','HomeController@testSql');
Route::get('curl', 'HomeController@testCurlPage');
Route::post('curl', 'HomeController@testCurlPage');
Route::any('test/code/{id?}', 'CodeController@send');
Route::get('create_table', 'DatabaseController@createTable');
Route::get('view', 'HomeController@view');
//启动APP
$router->run();