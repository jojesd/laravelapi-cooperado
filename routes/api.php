<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cooperadosControllerApi;
use App\Http\Controllers\TokenController;



Route::group(['middleware' => 'token.validation'], function () {
    Route::get('/getCooperados', [cooperadosControllerApi::class, 'index']);
});

Route::group(['middleware' => 'token.validation'], function () {
    Route::post('/geraCooperado', [cooperadosControllerApi::class, 'store']);
});

Route::group(['middleware' => 'token.validation'], function () {
    Route::get('/getCooperados/{id}', [cooperadosControllerApi::class, 'show']);
});

Route::group(['middleware' => 'token.validation'], function () {
    Route::put('/editCooperado/{id}', [cooperadosControllerApi::class, 'update']);
});

Route::group(['middleware' => 'token.validation'], function () {
    Route::delete('/delCooperado/{id}', [cooperadosControllerApi::class, 'destroy']);
});

Route::controller(TokenController::class)->group(function () {
    Route::get('/gerarToken/{user}/{password}', 'gerarToken');
});
##########

