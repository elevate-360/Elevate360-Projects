<?php

use App\Http\Controllers\{LoginController, EmailController, IndexController, MailsController};
use Illuminate\Support\Facades\Route;

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

Route::get('/', [IndexController::class, 'index']);
Route::get('/login', [LoginController::class, 'view'])->name('login');
Route::post('/login/submit', [LoginController::class, 'login']);
Route::get('/index', [IndexController::class, 'index'])->name('index');
Route::get('/data', [IndexController::class, 'data'])->name('data');
Route::get('/email', [EmailController::class, 'view']);
Route::post('/email/send', [EmailController::class, 'sendEmail']);
Route::post('/data/submit', [IndexController::class, 'insertData']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/mail', [MailsController::class, 'getMail']);
Route::get('/render', [MailsController::class, 'getBody']);
Route::get('/mails', [MailsController::class, 'index']);
Route::get('/inbox', [MailsController::class, 'getInboundMails']);
Route::get('/mail/{id}', [MailsController::class, 'render']);
Route::get('/forgot-password', function () {
    return view('forget');
});
