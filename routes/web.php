<?php

use Illuminate\Support\Facades\Route;

// Route::get('/admin', function () {
//     return redirect('/admin/dashboard');
// });

// Route::get('/login', function () {
//     return response()->json(['message' => 'Please login'], 401);
// })->name('login');

Route::redirect('/', '/admin/login');
