<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Change password
Route::resource('change-password', 'ChangePasswordController');
//Logout
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Phân quyền truy cập
Route::get('/admin', 'AdminController@index');
Route::get('/superadmin', 'SuperAdminController@index');

//Demo Post
Route::resource('/posts', 'PostsControllers');
Route::get('/filte', 'PostsControllers@filterByCategories')->name('posts.filterByCategory');
Route::get('/posts-search', 'PostsControllers@search')->name('posts.search');
Route::get('/posts-search-trash', 'PostsControllers@searchTrash')->name('posts.search-trash');
Route::get('/posts-trash', 'PostsControllers@trashed')->name('posts.trash');
Route::get('/posts/{id}/restore', 'PostsControllers@restore')->name('posts.restore');
Route::get('/posts-restore-all', 'PostsControllers@restoreAll')->name('posts.restore-all');
Route::get('/posts/{id}/delete', 'PostsControllers@delete')->name('posts.delete');
Route::get('/posts-delete-all', 'PostsControllers@deleteAll')->name('posts.delete-all');


//Categories
Route::resource('/categories', 'CategoriesControllers');
Route::get('/categories-search', 'CategoriesControllers@search')->name('categories.search');
Route::get('/categories-search-trash', 'CategoriesControllers@searchTrash')->name('categories.search-trash');
Route::get('/categories-trash', 'CategoriesControllers@trashed')->name('categories.trash');
Route::get('/categories/{id}/restore', 'CategoriesControllers@restore')->name('categories.restore');
Route::get('/categories-restore-all', 'CategoriesControllers@restoreAll')->name('categories.restore-all');
Route::get('/categories/{id}/delete', 'CategoriesControllers@delete')->name('categories.delete');
Route::get('/categories-delete-all', 'CategoriesControllers@deleteAll')->name('categories.delete-all');

// Route::group(['middleware' => ['web']], function () {
//     Route::get('session', function () {
//         Session::put('KhoaHoc', 'Laravel');
//         Session::put('web', 'hello');
//         Session::flash('hello', 'hi');
//         // echo "Success <br>";
//         echo Session::get('KhoaHoc');
//         echo "<br>";
//         echo Session::get('web');
//         echo Session::get('hello');
//         // Session::flush();
//         // Session::forget('KhoaHoc');
//         // if (Session::has('KhoaHoc')) {
//         //     echo "Da co session";
//         // } else {
//         //     echo "Khong co";
//         // }
//     });
// });

// Route::get('hello', function () {
//     echo Session::get('hello');
// });