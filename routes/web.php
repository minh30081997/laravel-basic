<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

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

// Blade Template
Route::get('BladeTemplate', 'MyController@blade');

// Create table with Schema
Route::get('database', function () {
    Schema::create('loaisanpham', function ($table) {
        $table->Increments('id');
        $table->string('ten', 255);
        $table->timestamps();
    });

    echo "Success";
});

// rename, delete table
Route::get('lienketbang', function () {
    Schema::create('sanpham', function ($table) {
        $table->Increments('id');
        $table->string('ten', 255);
        $table->float('gia');
        $table->integer('soluong')->default(0);
        $table->integer('id_loaisanpham')->unsigned();
        $table->foreign('id_loaisanpham')->references('id')->on('loaisanpham');
        $table->timestamps();
    });

    echo "success";
});
