<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth.nexus:passkey']], function () {
    Route::post("pieces-hash", [\App\Http\Controllers\TorrentController::class, "queryByPiecesHash"])->name("torrent.pieces_hash.query");
});


Route::post('challenge', [\App\Http\Controllers\AuthenticateController::class, 'challenge']);

Route::post('nastools/approve', [\App\Http\Controllers\AuthenticateController::class, 'nasToolsApprove']);
Route::get('iyuu/approve', [\App\Http\Controllers\AuthenticateController::class, 'iyuuApprove']);
Route::post('ammds/approve', [\App\Http\Controllers\AuthenticateController::class, 'ammdsApprove']);

