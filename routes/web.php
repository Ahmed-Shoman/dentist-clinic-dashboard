<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;



Route::get('/', function () {
    return view('welcome');
});


route::get('/site',function(){

    return config::get('services.site_name');
});
