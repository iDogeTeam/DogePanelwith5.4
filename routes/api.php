<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

// Telegram Bot
Route::post( env('TELEGRAM_BOT_TOKEN').'/webhook',function () {
	$update = Telegram::commandsHandler(true);

	// Commands handler method returns an Update object.
	// So you can further process $update object
	// to however you want.

	return 'ok';
});

// Deprecated Webapi 相关
Route::group(['prefix' => 'mu', 'middleware' => 'mu'], function () {
	Route::get('/users', 'API\Muv2Controller@userInfo');  // I don't get it.
	Route::post('/users/{id}/traffic', 'API\Muv2Controller@addUserTraffic');
	/* @TODO This api is gonna kill me
	 * $this->get('/nodes/{id}/users', 'API/Muv2Controller@nodeTraffic');
	 * $this->post('/nodes/{id}/online_count', 'App\Controllers\MuV2\NodeController:onlineUserLog');
	 * $this->post('/nodes/{id}/info', 'App\Controllers\MuV2\NodeController:info');
	 * $this->post('/nodes/{id}/traffic', 'App\Controllers\MuV2\NodeController:postTraffic');
	 */
});


Route::group(['prefix' => '/{token}', 'middleware' => 'server'], function () {
	// Shadowsocks
	Route::group(['prefix' => '/shadowsocks/',], function () {
		Route::get('user', 'API\ShadowsocksController@user');
		Route::post('traffic', 'API\ShadowsocksController@traffic');
		Route::post('error', 'API\ShadowsocksController@error');
	});
	// Anyconnect
	Route::group(['prefix' => '/anyconnect/',], function () {
		Route::get('user', 'API\AnyconnectController@user');
		Route::post('traffic', 'API\AnyconnectController@traffic');
		Route::post('error', 'API\AnyconnectController@error');
	});
});

