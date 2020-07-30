<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;
use App\Topic;
use App\Category;
use App\Comment;
use App\LoaiSanPham;
use App\SanPham;
use Dotenv\Result\Success;
use SebastianBergmann\Environment\Runtime;

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

// Database Relationship
// Model save data san pham
Route::get('model/save/sanpham', function () {
    $sanpham = new SanPham();

    $sanpham->Ten = 'iPhone';
    $sanpham->Gia = 500;
    $sanpham->loaisanpham_id = 2;
    $sanpham->SoLuong = 10;

    $sanpham->save();

    echo "success";
});

// Get loaisanpham from sanpham
Route::get('sanpham/{id}', function ($id) {
    $sanpham = SanPham::find($id);

    $loaisanpham = SanPham::find($id)->loaisanpham()->get()->toArray();

    // dd($sanpham);
    dd($loaisanpham);
});

Route::get('loaisanpham/{id}', function ($id) {
    $loaisanpham = LoaiSanPham::find($id);

    $sanpham = LoaiSanPham::find($id)->sanpham()->get()->toJson();

    // dd($loaisanpham);
    dd($sanpham);
});

// Create table topics
Route::get('createTopic', function () {
    Schema::create('topics', function ($table) {
        $table->Increments('id');
        $table->string('name', 255);
        $table->timestamps();
    });

    echo 'Success';
});

// Create table categories
Route::get('createCate', function () {
    Schema::create('categories', function ($table) {
        $table->Increments('id');
        $table->string('name', 255);
        $table->integer('topic_id')->unsigned();
        $table->foreign('topic_id')->references('id')->on('topics');
        $table->timestamps();
    });

    echo 'Success';
});

// Create table posts
Route::get('createPost', function () {
    Schema::create('posts', function ($table) {
        $table->Increments('id');
        $table->string('name', 255);
        $table->text('content');
        $table->integer('cate_id')->unsigned();
        $table->foreign('cate_id')->references('id')->on('categories');
        $table->timestamps();
    });

    echo 'Success';
});

// Create table comments
Route::get('createComment', function () {
    Schema::create('comments', function ($table) {
        $table->Increments('id');
        $table->text('content');
        $table->integer('post_id')->unsigned();
        $table->foreign('post_id')->references('id')->on('posts');
        $table->timestamps();
    });

    echo 'Success';
});

// Query data in eloquent model
// Get post of user 1
Route::get('user/1/post', function () {
    $user = User::find(1);

    $posts = $user->post->toArray();
    // $posts = $user->post()->get()->toArray();

    dd($user);
});

// Get all posts with at least one comment 
Route::get('post/least/1/comment', function () {
    $posts = Post::has('comment')->get();
    dd($posts);
});

// Get all posts with at comment more 3
Route::get('post/comment/more/3', function () {
    $posts = Post::has('comment', '>=', 3)->get()->toArray();

    dd($posts);
});

// withCount
Route::get('withCount', function () {
    $posts = Post::withCount('comment')->get();

    foreach ($posts as $post) {
        echo $post->comment_count;
        echo '<br>';
    }
});

// Method save()
Route::get('saveComment', function () {
    $comment = new Comment(['content' => 'new comment']);
    $user = User::find(1);

    $user->comment()->save($comment);

    echo 'Success';
});

// Lazy load
Route::get('lazyLoad', function () {
    $posts = Post::all();

    foreach ($posts as $post) {
        echo $post->user->name . ': ' . $post->id;
    }
});

// Eager load
Route::get('eagerLoad', function () {
    $posts = Post::with('user')->get();

    foreach ($posts as $post) {
        echo $post->user->name . ': ' . $post->id;
    }
});

// test eloquent model user and user()
Route::get('user', function () {
    $posts = Post::find(1);
    $user = $posts->user    ;

    dd($user);
}); 

// Accessor
Route::get('accessor', function () {
    $user = User::find(1);
    echo $user->name;
    return $upper_name = $user->name;
});

// Mutator
// Add user in table users
Route::get('add/user', function () {
    $user = new User();

    $user->name = 'min';
    $user->email = 'min@gmail.com';
    $user->password = '12345';

    $user->save();

    echo 'Success';
});

// Add user in table users with mutator
Route::get('add/user/mutator', function () {
    $user = new User();

    $user->name = 'min min';
    $user->email = 'minmin@gmail.com';
    $user->password = '12345';

    $user->save();

    echo 'Success';
});

// Middleware
// Vi du ve nhap diem don gian voi middleware
Route::get('diem', function () {
    echo 'Ban da du diem';
})->middleware('MyMiddleware')->name('diem');

Route::get('loi', function () {
    echo 'Ban chua du diem';
})->name('loi');

Route::get('nhapdiem', function () {
    return view('nhapdiem');
});

// Pass parameters to middleware
Route::get('role', function () {
    echo '<br>';
    echo 'Success';
})->middleware('RoleMiddleware:admin');

// Terminable Middleware
Route::get('terminable', function () {
    echo '<br>';
    echo 'Success';
})->middleware('TerminableMiddleware:save success');


// Pagination 
Route::get('paginate', function () {
    $posts = Post::paginate(2);
    return view('post')->with(['posts' => $posts]);
});

// Auth
Route::get('dangnhap', function () {
    return view('login');
});

Route::post('login', 'AuthController@login')->name('login');

Route::get('test', function () {
    return view('success');
});

Route::get('logout', 'AuthController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Authorization 
Route::get('/posts', 'PostController@index')->name('list_posts');
Route::group(['prefix' => 'posts'], function () {
    Route::get('/drafts', 'PostController@drafts')
        ->name('list_drafts')
        ->middleware('auth');

    Route::get('/show/{id}', 'PostController@show')
        ->name('show_post');

    Route::get('/create', 'PostController@create')
        ->name('create_post')
        ->middleware('can:post.create');
    Route::post('/create', 'PostController@store')
        ->name('store_post')
        ->middleware('can:post.create');
    
    Route::get('/edit/{id}', 'PostController@edit')
        ->name('edit_post')
        ->middleware('can:post.update, post');
    Route::post('/edit/{id}', 'PostController@update')
        ->name('update_post')
        ->middleware('can:post.update, post');
    
    Route::get('publish/{id}', 'PostController@published')
        ->name('publish_post')
        ->middleware('can:post.publish');
});

Route::get('result', 'PostController@test');
Route::get('test/{id}', function ($id) {
    echo $id;
})->name('test');


// Activation Email
Route::get('user/activation/{token}', 'Auth\RegisterController@activateUser')->name('user.activate');


// Forgot password with email
// Solution 1: 
Route::get('reset-password', 'ForgotPasswordController@getFormResetPassword')->name('get.reset.password');
Route::post('reset-password', 'ForgotPasswordController@sendCodeResetPassword')->name('send.code.reset.password');
Route::get('/password/reset', 'ForgotPasswordController@resetPassword')->name('get.link.reset.password');
Route::post('/password/reset', 'ForgotPasswordController@saveResetPassword')->name('save.reset.password');

// Solution 2:
// Route::get('resetPassword', 'ForgotPasswordController@getForm')->name('get.form');
// Route::post('resetPassword', 'ForgotPasswordController@sendToken')->name('send.token');
// Route::get('reset', 'ForgotPasswordController@getReset')->name('get.reset');
// Route::post('reset', 'ForgotPasswordController@saveReset')->name('save.reset');

// Solution 3:
Route::get('resetPassword', 'ForgotPasswordController@getForm')->name('get.form');
Route::post('resetPassword', 'ForgotPasswordController@sendToken')->name('send.token');
Route::get('reset', 'ForgotPasswordController@getReset')->name('get.reset');
Route::post('reset', 'ForgotPasswordController@saveReset')->name('save.reset');
