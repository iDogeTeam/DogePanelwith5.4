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

// 着陆页
Route::get('/', 'HomeController@index');

// 附属条款
Route::get('/tos', 'HomeController@showTos');

// 验证路由
Auth::routes();

// **公开页面结束**

/*
 * | **内部路由开始**
 */


Route::group(['middleware' => 'auth'], function () {

	// 验证用户路由
	Route::post('verify', 'HomeController@doVerification')->middleware('item');

	// 正式用户路由
	Route::group(['middleware' => 'active'], function () {
		// 服务信息

		// @TODO 测试条目
		Route::get('test', 'UserController@test');

		// 服务信息
		Route::group(['prefix' => 'service'], function () {
			Route::get('/', 'ServiceController@listAllServices');
			Route::group(['prefix' => '/{sid}', 'middleware' => 'belong.service'], function () {
				Route::get('/', 'ServiceController@showIndividualService');
				Route::group(['prefix' => 'node'], function () {
					// 节点信息
					Route::get('/', 'NodeController@listAllNodesWithinAService');
					Route::get('/{nid}', 'NodeController@showIndividualNodes')->middleware('belong.node');
				});
			});
		});

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

		// 礼品码信息，暂不处理
		/*Route::group(['prefix' => 'giftcode'], function () {
			Route::get('/', 'GiftCodeController@index');
			Route::post('/', 'GiftCodeController@createIndividualCode');
		});*/

		// 销毁
		Route::get('/destroy', 'UserController@suicide');
		Route::post('/destroy', 'UserController@suicide');

		Route::post('/checkin', 'UserController@doUserCheckIn');

	});

	// 系统信息
	Route::get('/system', 'HomeController@gist');

});


// 管理路由
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {

	// 着陆页
	//Route::get('/dashboard', 'Admin\HomeController@index');

	// 面板信息

	Route::get('/system', 'Admin\HomeController@systemInfo');

	// 面板管理
	Route::group(['prefix' => 'config'], function () {
		Route::get('/{id}', 'Admin\ConfigController@showIndividual');
		Route::post('/{id}', 'Admin\ConfigController@addIndividual');
		Route::post('/{id}/edit', 'Admin\ConfigController@modifyIndividual');
		Route::delete('/{id}/delete', 'Admin\ConfigController@deleteIndividual');
	});

	// 用户管理
	Route::group(['prefix' => 'user'], function () {
		Route::get('/', 'Admin\UserController@index');
		Route::get('/{id}', 'Admin\UserController@showIndividual');
		Route::post('/{id}', 'Admin\UserController@addIndividual');
		Route::post('/{id}/edit', 'Admin\UserController@modifyIndividual');
		Route::delete('/{id}/delete', 'Admin\UserController@deleteIndividual');
	});

	// 节点管理
	Route::group(['prefix' => 'node'], function () {
		Route::get('/', 'Admin\NodeController@index');
		Route::get('/{id}', 'Admin\NodeController@showIndividual');
		Route::post('/{id}', 'Admin\NodeController@addIndividual');
		Route::post('/{id}/edit', 'Admin\NodeController@modifyIndividual');
		Route::delete('/{id}/delete', 'Admin\NodeController@deleteIndividual');
	});

	// 礼品码信息，暂不处理
	Route::group(['prefix' => 'giftcode'], function () {
		Route::get('/', 'Admin\GiftCodeController@index');
		Route::get('/{id}', 'Admin\GiftCodeController@showIndividual');
		Route::post('/{id}', 'Admin\GiftCodeController@addIndividual');
		Route::post('/{id}/edit', 'Admin\GiftCodeController@modifyIndividual');
		Route::delete('/{id}/delete', 'Admin\GiftCodeController@deleteIndividual');
	});

});

