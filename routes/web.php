<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontController::class, 'index']);
Route::post('auth', [FrontController::class, 'auth'])->name('auth');

Route::group(['middleware' => 'user_auth'], function () {
    
    Route::any('dashboard', [FrontController::class, 'dashboard'])->name('dashboard');



    // Logout
    Route::get('logout', function () {
        session()->forget('UserLogin');
        session()->forget('UserID');
        session()->forget('key');
        return redirect('/');
    });
});



