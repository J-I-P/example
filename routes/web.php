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

//使用者註冊頁面
Route::get('/user/auth/sign-up');
//使用者資料新增
Route::post('/user/auth/sign-up');
//使用者登入頁面
Route::get('/user/auth/sign-in');
//使用者登入處理
Route::post('/user/auth/sign-in');
//使用者登出
Route::get('/user/auth/sign-out');

//商品清單檢視
Route::get('/merchandise');
//商品管理清單檢視
Route::get('/merchandise/manage');
//商品資料新增
Route::get('/merchandise/create');
//商品單品檢視
Route::get('/merchandise/{merchandise_id}');
//商品單品編輯頁面檢視
Route::get('/merchandise/{merchandise_id}/edit');
//商品單品資料修改
Route::put('/merchandise/{merchandise_id}');
//購買商品
Route::post('/merchandise/{merchandise_id}/buy');
//交易紀錄頁面檢視
Route::get('/transaction');

