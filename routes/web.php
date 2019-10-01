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
 
Route::post('change-password', 'Auth\ChangePasswordController@postChangePassword')->name('change-password');

Auth::routes();

Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    Route::resource('target', 'TargetController');
    Route::resource('user', 'AkunController', [
        'except' => ['show', 'create']
    ]);
});

Route::group(['middleware' => ['auth', 'role:superadmin|admin']], function () {
    
    Route::get('/dashboard', 'HomeController@index');
    Route::get('/', 'HomeController@index')->name('home');
    Route::put('user/{id}/update/password', 'AkunController@gantiPassword');
    Route::resource('profil', 'ProfilController', [
        'except' => ['show', 'create', 'store', 'edit', 'destroy']
    ]);
    Route::patch('profil/{id}/update/ava', 'ProfilController@gantiAva');
    Route::patch('profil/{id}/update/password', 'ProfilController@gantiPassword');

    Route::get('drafts', 'CartController@index')->name('cart.index');
    Route::get('drafts/{draftKey}', 'CartController@show')->name('cart.show');
    Route::post('drafts/{draftKey}', 'CartController@store')->name('cart.store');
    Route::post('cart/add-draft', 'CartController@add')->name('cart.add');
    Route::post('cart/add-draft-item/{draftKey}/{product}', 'CartController@addDraftItem')->name('cart.add-draft-item');
    Route::patch('cart/update-draft-item/{draftKey}', 'CartController@updateDraftItem')->name('cart.update-draft-item');
    Route::patch('cart/{draftKey}/proccess', 'CartController@proccess')->name('cart.draft-proccess');
    Route::delete('cart/remove-draft-item/{draftKey}', 'CartController@removeDraftItem')->name('cart.remove-draft-item');
    Route::delete('cart/empty/{draftKey}', 'CartController@empty')->name('cart.empty');
    Route::delete('cart/remove', 'CartController@remove')->name('cart.remove');
    Route::delete('cart/destroy', 'CartController@destroy')->name('cart.destroy');
    Route::get('transactions', ['as' => 'transactions.index', 'uses' => 'TransactionsController@index']);
    Route::get('transactions/{transaction}', ['as' => 'transactions.show', 'uses' => 'TransactionsController@show']);
    Route::get('transactions/{transaction}/pdf', ['as' => 'transactions.pdf', 'uses' => 'TransactionsController@pdf']);
    Route::get('transactions/{transaction}/receipt', ['as' => 'transactions.receipt', 'uses' => 'TransactionsController@receipt']);
    Route::post('transactions/jenispembayaran', 'TransactionsController@jenisPembayaran');
    Route::post('transactions/mediapembelian', 'TransactionsController@mediaPembelian');
    Route::post('transactions/jasakirim', 'TransactionsController@jasaKirim');
    Route::post('transactions/customer', 'TransactionsController@customer');
    Route::put('transactions/edit/{id}', 'TransactionsController@editOngkir');
    
    Route::post('proses', 'TransactionsController@proses')->name('transaksi.proses');
    Route::group(['prefix' => 'reports'], function () {
        Route::get('sales', ['as' => 'reports.sales.index', 'uses' => 'Reports\SalesController@monthly']);
        Route::get('sales/daily', ['as' => 'reports.sales.daily', 'uses' => 'Reports\SalesController@daily']);
        Route::get('sales/monthly', ['as' => 'reports.sales.monthly', 'uses' => 'Reports\SalesController@monthly']);
        Route::get('sales/yearly', ['as' => 'reports.sales.yearly', 'uses' => 'Reports\SalesController@yearly']);
    });

    Route::get('products/price-list', ['as' => 'products.price-list', 'uses' => 'ProductsController@priceList']);
    Route::resource('products', 'ProductsController', ['except' => ['create', 'edit']]);
    Route::put('products/{id}/denied', 'ProductsController@denied')->name('products.denied');
    Route::get('product/edit/{id}', 'ProductsController@edit')->name('products.stok.edit');
    Route::put('product/ingredient/edit', 'ProductsController@updateSatuan')->name('products.updateSatuan');
    Route::delete('product/ingredient/delete', 'ProductsController@destroySatuan')->name('products.deleteSatuan');
    Route::resource('units', 'UnitsController', ['except' => ['create', 'show', 'edit']]);
    Route::resource('ingredient', 'IngredientController',['except' => ['create', 'show', 'edit']]);
    Route::get('stok', 'StokController@index');
    Route::get('stok/min', 'StokController@stok');
    Route::post('stok/supplier', 'StokController@supplier');
    Route::get('stok/kartu', 'StokController@kartuStok');
    Route::post('stok/kartu', 'StokController@addStok');
    Route::post('stok/kartu/kiloan', 'StokController@addStokKiloan');
    Route::post('stok/kartu/kiloan-satuan', 'StokController@addStokKiloanSatuan');

    Route::resource('customer', 'CSController', ['only' => ['index','show']]);
    Route::post('customer/tipe', 'CSController@customer');
    Route::get('customer/history/{customer}', 'CSController@history');
    Route::resource('konsultasi', 'KonsultasiController');
    Route::get('transactions/{transaction}', ['as' => 'transactions.show', 'uses' => 'TransactionsController@show']);
    Route::post('add/ingredient', 'ProductsController@addSatuan')->name('add.ingredient');
    Route::post('add/kategory_ingredient', 'ProductsController@addKategory')->name('add.kategory');
    Route::delete('deletekategory/{id}', 'ProductsController@deletekategory')->name('delete.kategory');
    Route::put('editkategory/{id}', 'ProductsController@editkategory')->name('edit.kategory');
    Route::delete('delete/transaction/{id}', 'TransactionsController@delete')->name('delete.transaction');

});
    // Route::resource('users', 'UsersController', ['except' => ['create', 'show', 'edit']]);

