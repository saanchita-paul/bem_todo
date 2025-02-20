<?php

use App\Http\Controllers\TodoController;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('todos', TodoController::class);

Route::get('/test', function (){
   $user = User::find(1);
   $user->notify(new \App\Notifications\TodoReminderNotification());
   dd('last line');

});
