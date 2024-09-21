<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\welcomeMail;
use App\Http\Controllers\MyaccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MyprofileController;
use App\Http\Controllers\ProductController;






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

// Route::get('/home', 'HomeController@index')->name('home');


// custom logins
Route::view('/login', 'customlogin.login_user')->name('login');
Route::post('/login/check', 'AuthController@login')->name('login.check');
Route::view('/register/user', 'customlogin.register_user')->name('user.register');
Route::post('/register/user', 'UsersController@register')->name('register_user.store');



Route::get('/admin/login', function () {
    return view('customlogin.login_admin'); // Replace 'vendor.login' with the view name for vendor login
})->name('admin.login');

Route::post('/login/check', 'AuthController@login')->name('login.check');


Route::post('/login/check/admin', 'AdminController@login')->name('login.check_admin');


Route::get('/register-user', function () {
    return view('customlogin.register_user'); // Adjust view path if necessary
})->name('user.register');

// custom logins ends here



// frontend routes


// Route::view('/home', 'frontend.index')->name('home');

// Route::view('/login/user', 'customlogin.login_user')->name('login');

// Show the login form
Route::get('/login', 'AuthController@loginForm')->name('login');

// Handle login request
Route::post('/login', 'AuthController@login')->name('login.submit');

// Home route
Route::view('/home', 'frontend.index')->name('home'); 

// Handle logout request
Route::post('/logout', 'AuthController@logout')->name('logout');

// myaccount

// Route::view('/myaccount', 'frontend.my-account')->name('myaccount');
Route::view('/wishlist', 'frontend.wishlist')->name('wishlist');

// myaccount update

// Route to show the account form
Route::get('/myaccount', 'MyaccountController@showAccount')->name('myaccount');

// Route to handle the account update
Route::put('/myaccount/update', 'MyaccountController@updateAccount')->name('myaccount.update');




// backend dashboard
  

Route::view('/dashboard', 'backend.index')->name('admin.dashboard')->middleware('admin'); 


// admin logout
Route::post('/admin/logout','AdminController@logout')->name('admin.logout');

// myprofile
// Route::view('/dashboard/myprofile', 'backend.profilemanage')->name('myprofile')->middleware('admin'); 
Route::get('/admin/profile','MyprofileController@showProfile')->name('myprofile')->middleware('admin');


Route::view('/dashboard/abhi', 'backend.common.abhi')->name('test'); 

// admin profile update
Route::post('/admin/profile/update', 'MyprofileController@updateProfile')->name('admin.updateProfile');


Route::get('/admin/site-settings', 'SiteSettingsController@index')->name('site-settings.index');
Route::put('/admin/site-settings', 'SiteSettingsController@update')->name('site-settings.update');




// Route::post('/settings/store', 'SiteSettingController@store')->name('settings.store');



// for products
Route::get('/products','ProductsController@index')->name('products.index')->middleware('admin');
Route::get('/products/create','ProductsController@create')->name('products.create')->middleware('admin');
Route::post('/products/store','ProductsController@store')->name('products.store')->middleware('admin');
Route::delete('/products/{id}', 'ProductsController@delete')->name('products.delete')->middleware('admin');
Route::get('/products/edit/{id}','ProductsController@edit')->name('products.edit')->middleware('admin');
Route::put('/products/update/{id}','ProductsController@update')->name('products.update')->middleware('admin');





