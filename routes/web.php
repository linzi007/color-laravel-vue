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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/lg', function () {
    Auth::logout();
    return redirect('/');
});

Route::get('/test', function () {
    $mainOrders = \App\Models\MainOrder::with('orderGoods')->where('pay_id', '<=', '10923')->orderBy('pay_id', 'desc')->limit(50)->get();

    $goodsIds = $mainOrders->map(function ($mainOrder) {
        return $mainOrder->orderGoods;
    })->flatten(1)->map(function ($orderGoods) {
        return $orderGoods->goods_id;
    })->unique();
    //取得订单对应的goods_id
    $goodsList = \App\Models\Goods::with('goodsCommon')->whereIn('goods_id', $goodsIds)->get();
    $goodsList = $goodsList->toArray();
    dd($goodsList);
});
Route::get('/user/info', function () {
    $user = Auth::user()->toArray();
    $user['role'] = ['admin'];
    $user['avatar'] = 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif';
    return $user;
});
//Auth Illuminate/Routing/Router->auth()
Auth::routes();


//home
Route::get('/home', 'HomeController@index')->name('home');

//passport 操作页面
Route::get('/passport', function () {
    return view('auth.passport');
});

//test access-token
Route::get('/access-token', function () {
    $http = new GuzzleHttp\Client;
    $response = $http->post('http://laravel.dev/oauth/token', [
        'form_params' => [
            'grant_type' => 'password',
            'client_id' => '1',
            'client_secret' => 'KWkbPs7N6tSQOMSez0OFf4PmQ56Ue8DxAqFEBDwg',
            'username' => 'linzi',
            'password' => '123456',
            'scope' => '',
        ],
    ]);
    return json_decode((string) $response->getBody(), true);
});

Route::get('/refresh-token', function () {
    $http = new GuzzleHttp\Client;
    $response = $http->post('http://laravel.dev/oauth/token', [
        'form_params' => [
            'grant_type' => 'refresh_token',
            'client_id' => '1',
            'client_secret' => 'KWkbPs7N6tSQOMSez0OFf4PmQ56Ue8DxAqFEBDwg',
            'username' => 'linzi',
            'password' => '123456',
            'scope' => '',
        ],
    ]);
});

//司机信息
Route::resource('drivers', 'DriversController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::resource('goods_settings', 'GoodsSettingsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::resource('main_order_payments', 'MainOrderPaymentsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::resource('sub_order_payments', 'SubOrderPaymentsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::resource('order_goods_payments', 'OrderGoodsPaymentsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);