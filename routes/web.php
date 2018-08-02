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

Route::get('/plus', 'ToDoController@plus');

Route::group(['prefix' => 'user'], function(){
    Route::group(['prefix' => 'auth'], function(){
        //使用者註冊頁面
        Route::get('/sign-up', 'User\UserAuthController@signUpPage');
        //使用者資料新增
        Route::post('/sign-up', 'User\UserAuthController@signUpProcess');
        //使用者登入頁面
        Route::get('/sign-in', 'User\UserAuthController@signInPage');
        //使用者登入處理
        Route::post('/sign-in', 'User\UserAuthController@signInProcess');
        //使用者登出
        Route::get('/sign-out', 'User\UserAuthController@signOut');
    });

});


Route::group(['prefix' => 'merchandise'], function(){
    //商品清單檢視
    Route::get('/', 'Merchandise\MerchandiseController@merchandiseListPage');
    //商品管理清單檢視
    Route::get('/manage', 'Merchandise\MerchandiseController@merchandiseManageListPage');
    //商品資料新增
    Route::get('/create', 'Merchandise\MerchandiseController@merchandiseCreateProcess');
    Route::group(['prefix' => '{merchandise_id}'], function(){
        //商品單品檢視
        Route::get('/', 'Merchandise\MerchandiseController@merchandiseItemPage');
        //商品單品編輯頁面檢視
        Route::get('/edit', 'Merchandise\MerchandiseController@merchandiseItemEditPage');
        //商品單品資料修改
        Route::put('/', 'Merchandise\MerchandiseController@merchandiseItemUpdateProcess');
        //購買商品
        Route::post('/buy', 'Merchandise\MerchandiseController@merchandiseItemBuyProcess');
    });
});

//交易紀錄頁面檢視
Route::get('/transaction', 'Transaction\TransactionController@transactionListPage');

