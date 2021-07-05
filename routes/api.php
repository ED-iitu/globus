<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/v1/facilities', 'FacilityController@getAll')->name('facilities-list');
Route::get('/v1/facilities/getByCategory', 'FacilityController@getByCategory')->name('getByCategory');
Route::get('/v1/facility', 'FacilityController@getFacilityById')->name('getFacilityById');
Route::get('/v1/categories', 'CategoryController@getAll')->name('category-list');
Route::get('/v1/promotions', 'PromotionController@getAll')->name('getAllPromotions');
Route::get('/v1/promotion', 'PromotionController@getById')->name('getPromotionById');
Route::get('/v1/banners', 'BannerController@getAll')->name('getAllBanners');
Route::get('/v1/contact/info', 'ContactController@contactInfo')->name('contactInfo');
Route::get('/v1/about', 'AboutController@aboutInfo')->name('aboutInfo');
