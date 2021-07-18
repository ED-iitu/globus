<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('about','AboutController')->middleware('auth');
Route::resource('banner','BannerController')->middleware('auth');
Route::resource('category','CategoryController')->middleware('auth');
Route::resource('contact','ContactController')->middleware('auth');
Route::resource('facility','FacilityController')->middleware('auth');
Route::resource('globusInfo','GlobusInfoController')->middleware('auth');
Route::resource('infographic','InfographicController')->middleware('auth');
Route::resource('promotion','PromotionController')->middleware('auth');
Route::resource('renter','RenterController')->middleware('auth');
Route::resource('user','UserController')->middleware('auth');
Route::resource('my','MyFacilityController')->middleware('auth');
Route::resource('gallery', 'GalleryController')->middleware('auth');
