<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
    // return redirect('login');
});

Route::get('/register', function () {
    return view('auth.login');
    // return redirect('login');
})->name('auth.register');



Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',
])->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Route::get('/user/profile', function () {
    //     return view('profile.show');
    // })->name('perfil');

});
