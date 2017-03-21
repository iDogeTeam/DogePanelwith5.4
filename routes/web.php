<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
 * |   **注意**
 * | 以下为公开页面，请注意保护
 */
// 首页
Route::get('/', function () {
	return view('welcome');
});

// 附属条款
Route::get('/tos', function () {
	return view('tos');
});

// 验证路由
Auth::routes();

// **公开页面结束**

/*
 * | **内部路由开始**
 */

// 用户路由
Route::group(['middleware' => 'active'], function () {

	// 着陆页
	Route::get('/dashboard', 'HomeController@index');

	// 节点信息
	Route::group(['prefix' => 'node'], function () {
		Route::get('/', 'NodeController@index');
		Route::get('/{id}', 'NodeController@showIndividual')->where(['id' => '[0-9]+']);
	});

	// 用户信息
	Route::group(['prefix' => 'user'], function () {
		// 用户档案
		Route::group(['prefix' => 'profile'], function () {
			Route::get('/', 'UserController@showIndividual');
			Route::get('/edit', 'UserController@editIndividualInfo');
			Route::post('/edit', 'UserController@editIndividualInfo');
		});

		// 流量信息
		Route::group(['prefix' => 'log'], function () {
			Route::get('/', 'LogController@index');
			Route::get('/traffic', 'LogController@showIndividualTrafficInfo');
			Route::get('/checkin', 'LogController@showIndividualCheckInInfo');
		});

		// 邀请码信息,暂不处理
		Route::group(['prefix' => 'invite'], function () {
			Route::get('/', 'InviteController@showIndividualCode');
			Route::post('/', 'InviteController@createIndividualCode');
		});

		// 礼品码信息，暂不处理
		Route::group(['prefix' => 'giftcode'], function () {
			Route::get('/', 'GiftCodeController@index');
			Route::post('/', 'GiftCodeController@createIndividualCode');
		});

		// 销毁
		Route::get('/destroy', 'UserController@suicide');
		Route::post('/destroy', 'UserController@suicide');

	});

	// 系统信息
	Route::get('/system', 'HomeController@gist');

});


// 管理路由
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

	// 着陆页
	Route::get('/dashboard', 'Admin/HomeController@index');

	// 面板信息

	Route::get('/system', 'Admin/HomeController@systemInfo');

	// 面板管理
	Route::group(['prefix' => 'config'], function () {
		Route::get('/{id}', 'Admin/ConfigController@showIndividual')->where(['id' => '[0-9]+']);
		Route::post('/{id}', 'Admin/ConfigController@addIndividual')->where(['id' => '[0-9]+']);
		Route::post('/{id}/edit', 'Admin/ConfigController@modifyIndividual')->where(['id' => '[0-9]+']);
		Route::delete('/{id}/delete', 'Admin/ConfigController@deleteIndividual')->where(['id' => '[0-9]+']);
	});

	// 用户管理
	Route::group(['prefix' => 'user'], function () {
		Route::get('/', 'Admin/UserController@index');
		Route::get('/{id}', 'Admin/UserController@showIndividual')->where(['id' => '[0-9]+']);
		Route::post('/{id}', 'Admin/UserController@addIndividual')->where(['id' => '[0-9]+']);
		Route::post('/{id}/edit', 'Admin/UserController@modifyIndividual')->where(['id' => '[0-9]+']);
		Route::delete('/{id}/delete', 'Admin/UserController@deleteIndividual')->where(['id' => '[0-9]+']);
	});

	// 节点管理
	Route::group(['prefix' => 'node'], function () {
		Route::get('/', 'Admin/NodeController@index');
		Route::get('/{id}', 'Admin/NodeController@showIndividual')->where(['id' => '[0-9]+']);
		Route::post('/{id}', 'Admin/NodeController@addIndividual')->where(['id' => '[0-9]+']);
		Route::post('/{id}/edit', 'Admin/NodeController@modifyIndividual')->where(['id' => '[0-9]+']);
		Route::delete('/{id}/delete', 'Admin/NodeController@deleteIndividual')->where(['id' => '[0-9]+']);
	});

	// 礼品码信息，暂不处理
	Route::group(['prefix' => 'giftcode'], function () {
		Route::get('/', 'Admin/GiftCodeController@index');
		Route::get('/{id}', 'Admin/GiftCodeController@showIndividual')->where(['id' => '[0-9]+']);
		Route::post('/{id}', 'Admin/GiftCodeController@addIndividual')->where(['id' => '[0-9]+']);
		Route::post('/{id}/edit', 'Admin/GiftCodeController@modifyIndividual')->where(['id' => '[0-9]+']);
		Route::delete('/{id}/delete', 'Admin/GiftCodeController@deleteIndividual')->where(['id' => '[0-9]+']);
	});

});