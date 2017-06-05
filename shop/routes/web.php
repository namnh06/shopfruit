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
//admin group with middleware
Route::group(['prefix'=>'admin'],function(){
	//user
	Route::group(['prefix'=>'user'],function(){
		//get list user
		Route::get('list-user','UserController@getListUser')->name('list-user');
		//add new user
		Route::get('add-new-user-get','UserController@addNewUserGet')->name('add-new-user-get');
		Route::post('add-new-user-post','UserController@addNewUserPost')->name('add-new-user-post');
		//edit user
		Route::get('edit-user-get/{id}','UserController@editUserGet')->name('edit-user-get');
		Route::post('edit-user-post/{id}','UserController@editUserPost')->name('edit-user-post');
		//delete user
		Route::get('delete-user/{id}','UserController@deleteUser')->name('delete-user');
	});
	Route::group(['prefix'=>'category'],function(){
		//get list category
		Route::get('list-category','CategoryController@listCategory')->name('list-category');
		//add new category
		Route::get('add-new-category','CategoryController@addNewCategoryGet')->name('add-new-category-get');
		Route::post('add-new-category','CategoryController@addNewCategoryPost')->name('add-new-category-post');
		//edit user
		Route::get('edit-category/{id}','CategoryController@editCategoryGet')->name('edit-category-get');
		Route::post('edit-category/{id}','CategoryController@editCategoryPost')->name('edit-category-post');
		//delete user
		Route::get('delete-category/{id}','CategoryController@deleteCategory')->name('delete-category');
	});
});
//test
Route::get('test', function () {
	return view('admin.template.index-admin');
});
Route::get('test1',function(){
	return view('admin.layout.editable-table');
});
Route::get('test2',function (){
	return view('admin.template.test');
});
Route::get('test4',function(){
	return view('');
});