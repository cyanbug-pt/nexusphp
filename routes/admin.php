<?php
use Illuminate\Support\Facades\Route;

Route::get("/sse", [\App\Http\Controllers\ServerSendEventController::class, "sse"]);
