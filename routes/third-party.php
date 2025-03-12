<?php
use Illuminate\Support\Facades\Route;

Route::post('nastools/approve', [\App\Http\Controllers\AuthenticateController::class, 'nasToolsApprove']);
Route::get('iyuu/approve', [\App\Http\Controllers\AuthenticateController::class, 'iyuuApprove']);
Route::post('ammds/approve', [\App\Http\Controllers\AuthenticateController::class, 'ammdsApprove']);

