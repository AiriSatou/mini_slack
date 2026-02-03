<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});


Route::get('/dashboard', function () {
    $user = auth()->user();

    // last_channel があるならそこ
    if ($user->last_channel_id) {
        return redirect()->route('channels.show', $user->last_channel_id);
    }

    // なければ、最初のチャンネルへ（存在する場合）
    $firstChannelId = \App\Models\Channel::query()->orderBy('id')->value('id');
    if ($firstChannelId) {
        return redirect()->route('channels.show', $firstChannelId);
    }

    // チャンネルが1個も無い人だけ index
    return redirect()->route('channels.index');
})->middleware('auth')->name('dashboard');


require __DIR__.'/auth.php';


Route::middleware('auth')->group(function(){

    Route::get('/channels',[ChannelController::class,'index'])->name('channels.index');
    Route::post('/channels',[ChannelController::class,'store'])->name('channels.store');
    Route::get('/channels/{channel}',[ChannelController::class,'show'])->name('channels.show');
    Route::delete('/channels/{channel}', [ChannelController::class, 'destroy'])->name('channels.destroy');

    Route::post('/channels/{channel}/messages',[MessageController::class,'store'])->name('messages.store');
    Route::delete('/channels/{channel}/messages/{message}',[MessageController::class,'destroy'])->name('messages.destroy');
    Route::get('/channels/{channel}/messages/{message}/edit', [MessageController::class, 'edit'])->name('messages.edit');
    Route::put('/channels/{channel}/messages/{message}', [MessageController::class, 'update'])->name('messages.update');

    //プロフィール画面
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});




