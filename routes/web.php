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
Route::view('/home', 'frontend.index')->name('home'); // Adjust to your actual home controller and method

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



