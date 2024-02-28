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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'App\Http\Controllers\Authentication\RegisterController@register');
Route::post('/login', 'App\Http\Controllers\Authentication\LoginController@login');
Route::post('/recover-password', 'App\Http\Controllers\Authentication\RecoverPasswordController@recoverPassword');
Route::post('/reset-password/{token}', 'App\Http\Controllers\Authentication\ResetPasswordController@resetPassword');

Route::post('/blog-add-post', 'App\Http\Controllers\AdminPanel\Blog\BlogController@addBlogPost');
Route::post('/blog-add-photo', 'App\Http\Controllers\AdminPanel\Blog\BlogController@addBlogPhoto');
Route::post('/blog-add-meta/{slug}', 'App\Http\Controllers\AdminPanel\Blog\BlogController@addBlogMeta');
Route::post('/blog-add-content', 'App\Http\Controllers\AdminPanel\Blog\BlogController@addBlogContent');
Route::get('/blog-download-content/{slug}', 'App\Http\Controllers\AdminPanel\Blog\BlogController@downloadBlogContent');
Route::put('/blog-edit-content/{slug}', 'App\Http\Controllers\AdminPanel\Blog\BlogController@editBlogContent');
Route::get('/blog-list', 'App\Http\Controllers\AdminPanel\Blog\BlogController@downloadBlogList');
Route::delete('/blog-delete-article/{slug}', 'App\Http\Controllers\AdminPanel\Blog\BlogController@deleteBlogArticle');
Route::get('/blog-download-all-data', 'App\Http\Controllers\AdminPanel\Blog\BlogController@downloadBlogAllData');
Route::get('/blog-download-article/{slug}', 'App\Http\Controllers\AdminPanel\Blog\BlogController@downloadBlogArticle');
Route::get('/blog-download-meta/{slug}', 'App\Http\Controllers\AdminPanel\Blog\BlogController@downloadBlogMeta');

Route::post('/gallery-add', 'App\Http\Controllers\AdminPanel\Gallery\GalleryController@galleryAdd');
Route::post('/gallery-add-photos/{slug}', 'App\Http\Controllers\AdminPanel\Gallery\GalleryController@galleryAddPhotos');
Route::get('/gallery-list-download', 'App\Http\Controllers\AdminPanel\Gallery\GalleryController@downloadGalleryList');
Route::get('/gallery-list-collection-download/{slug}', 'App\Http\Controllers\AdminPanel\Gallery\GalleryController@downloadGalleryListCollection');
Route::delete('/gallery-delete/{slug}', 'App\Http\Controllers\AdminPanel\Gallery\GalleryController@deleteGallery');
Route::delete('/gallery-delete-collection/{id}', 'App\Http\Controllers\AdminPanel\Gallery\GalleryController@deleteGalleryCollection');

Route::get('/users-list', 'App\Http\Controllers\AdminPanel\Users\UsersController@downloadUsersList');
Route::delete('/user-delete/{id}', 'App\Http\Controllers\AdminPanel\Users\UsersController@deleteUser');

Route::get('/admin-settings-account', 'App\Http\Controllers\AdminPanel\Settings\SettingsController@adminSettingsAccount');
Route::post('/admin-change-password/{user_name}', 'App\Http\Controllers\AdminPanel\Settings\SettingsController@adminChangePassword');
Route::post('/admin-change-email/{user_name}', 'App\Http\Controllers\AdminPanel\Settings\SettingsController@adminChangeEmail');

Route::get('/download-statut', 'App\Http\Controllers\Documents\DocumentsController@downloadStatut');

Route::post('/send-form', 'App\Http\Controllers\Contact\ContactController@sendForm');