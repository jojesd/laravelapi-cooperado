<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cooperadosControllerApi;


Route::controller(cooperadosControllerApi::class)->group(function () {
    Route::get('/getCooperados', 'index');
});

Route::controller(cooperadosControllerApi::class)->group(function () {
    Route::post('/geraCooperado', 'store');
});

Route::controller(cooperadosControllerApi::class)->group(function () {
    Route::get('/getCooperados/{id}', 'show');
});

Route::controller(cooperadosControllerApi::class)->group(function () {
    Route::put('/editCooperado/{id}', 'update');
});

Route::controller(cooperadosControllerApi::class)->group(function () {
    Route::delete('/delCooperado/{id}', 'destroy');
});


