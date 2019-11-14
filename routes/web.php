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
Auth::routes();
Route::resource('users', 'UserController');
Route::resource('inventories', 'InventoryController');
Route::resource('menuItems', 'MenuItemController');
Route::resource('transactions', 'TransactionController');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');
Route::get('menuautocomplete', 'MenuItemController@searchAjax')->name('menuautocomplete');
Route::get('userautocomplete', 'UserController@searchAjax')->name('userautocomplete');
Route::get('inventoryautocomplete', 'InventoryController@searchAjax')->name('inventoriesautocomplete');
Route::get('transactionautocomplete', 'TransactionController@searchAjax')->name('transactionautocomplete');
Route::get('showrecipe', 'MenuItemController@showRecipeAjax')->name('showrecipe');
Route::get('showPrice', 'MenuItemController@showPriceAjax')->name('showprice');

//User routes
Route::get('/inventories', 'InventoryController@index')->name('viewInventories');
Route::get('/inventories/search', 'InventoryController@search')->name('searchInventories'); 
Route::get('/transaction', 'TransactionController@index')->name('addTransactions');
Route::get('/transaction/search', 'TransactionController@search')->name('searchTransaction');
Route::get('/menu/{var1}/{var2}', 'MenuItemController@index')->name('viewMenu');
Route::get('/menu/search', 'MenuItemController@search')->name('searchMenu');   
Route::get('/menu/filter/{var}/{var1}/{var2}', 'MenuItemController@filter')->name('filterMenu');

//Admin routes
Route::prefix('admin')->group(function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    
    // Password RESET
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

    //User Management
    Route::get('/users', 'UserController@index')->name('admin.manageUsers');
    Route::get('/search', 'UserController@search')->name('admin.searchUsers');   
    
    //Inventory Management
    Route::get('/inventories', 'InventoryController@index')->name('admin.manageInventories');
    Route::get('/inventories/search', 'InventoryController@search')->name('admin.searchInventories');   
    
    //Menu Management
    Route::get('/menu/{var1}/{var2}', 'MenuItemController@index')->name('admin.manageMenu');
    Route::get('/menu/search', 'MenuItemController@search')->name('admin.searchMenu');   
    Route::get('/menu/filter/{var}/{var1}/{var2}', 'MenuItemController@filter')->name('admin.filterMenu');
    
    //Making Orders
    Route::get('/transactions', 'TransactionController@index')->name('admin.manageTransaction');
    Route::get('/transaction/search', 'TransactionController@search')->name('admin.searchTransaction'); 
});