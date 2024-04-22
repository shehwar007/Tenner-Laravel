<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\Vendor\VendorController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    // return view('welcome');
    return redirect('/vendor/welcome');


});



// Redirect Breez Default Routes
// Route::redirect('/login', '/vendor/login');
// Route::redirect('/register', '/vendor/signup');



Route::get('/email/verify', [AuthController::class, 'verifyCode'])->name('email.verifyCode');
Route::post('/email/verify/sendcode', [AuthController::class, 'sendcode'])->name('email.sendcode');
Route::get('/email/verified/{token}', [AuthController::class, 'verify'])->name('email.verification');
Route::get('/email_verify_code', [AuthController::class, 'code'])->name('email.verification.code');

Route::get('/verifyEmail', [AuthController::class, 'verifyEmail'])->name('verifyEmail');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    





});

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/

Route::prefix('/admin')->middleware('guest:admin')->group(function () {
    // admin redirect to login page route
    Route::get('/', [AdminController::class,'login'])->name('admin.login');
    // Route::get('/sign-up', [AdminController::class,'signup'])->name('admin.signup');
    Route::post('/create', [AdminController::class,'create'])->name('admin.create');
    // admin login attempt route
    Route::post('/auth', [AdminController::class,'authentication'])->name('admin.auth');
  
    // admin forget password route
    Route::get('/forget-password', 'BackEnd\AdminController@forgetPassword')->name('admin.forget_password');
  
    // send mail to admin for forget password route
    Route::post('/mail-for-forget-password', 'BackEnd\AdminController@sendMail')->name('admin.mail_for_forget_password');
  });
  
require __DIR__.'/auth.php';
