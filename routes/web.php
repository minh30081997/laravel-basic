<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\User;

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

// Query Builder
Route::get('qb/get', function () {
    $data = DB::table('users')->get();
    foreach ($data as $row) {
        foreach ($row as $key => $value) {
            echo $key . ': ' . $value;
            echo '<br>';
        }

        echo '<br>';
    }
});

// Get 1 field or 1 column
Route::get('qb/field', function () {
    $data = DB::table('users')->where('name', 'HP')->first();
    dd($data);
});

// Fetch more column in table
Route::get('qb/fetchMore', function () {
    $data = DB::table('users')->pluck('id', 'name');

    $data1 = DB::table('users')->select('id', 'name')->get();
    dd($data);
    echo '<br>';
    var_dump($data1);
});

// Model
Route::get('model/save', function () {
    $user = new User();
    $user->name = 'Cong';
    $user->email = 'Cong@gmail.com';
    $user->password = bcrypt('password');

    $user->save();

    echo 'Save success';
});

// Model query
Route::get('model/query', function () {
    $user = User::find(3);
    dd($user);
});