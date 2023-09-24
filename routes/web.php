<?php

use Illuminate\Support\Facades\Route;

//

Route::get('/', 'App\Http\Controllers\IndexController@index')->name('/');
Route::get('/register', 'App\Http\Controllers\UserController@register')->name('register');
Route::post('/register', 'App\Http\Controllers\UserController@registeraccount');
Route::get('/login', 'App\Http\Controllers\UserController@login')->name('login');
Route::post('/login', 'App\Http\Controllers\UserController@loginaccount');
Route::get('/bets', 'App\Http\Controllers\BetController@index');
Route::get('/profile', 'App\Http\Controllers\ProfileController@index')->name('profile');
Route::get('/profile/{open_popup}', [\App\Http\Controllers\ProfileController::class, 'index']);




Route::get('/edit-profile/{id}', 'App\Http\Controllers\ProfileController@edit')->name('profile.edit');
Route::post('/update-profile', 'App\Http\Controllers\ProfileController@update')->name('profile.update');
Route::post('/bet', 'App\Http\Controllers\BetController@bet_fn')->name('bet');
Route::get('/show-all-bet/{game_id}', 'App\Http\Controllers\BetController@show_all_bet')->name('show.all.bet');

// room
Route::post('/submit-room', 'App\Http\Controllers\RoomController@submit_room')->name('room.submit');
Route::post('/update-room', 'App\Http\Controllers\RoomController@update_room')->name('update.room');

Route::post('/room-update', 'App\Http\Controllers\RoomController@on_change_new_room_update')->name('select.new.room.update');


// my streams
Route::get('/my_streams', [\App\Http\Controllers\MyStreamsController::class, 'index'])->name('my_streams.index');


// Label

Route::post('/submit-label', 'App\Http\Controllers\LabelController@submit_label')->name('submit.label');
Route::post('/update-label', 'App\Http\Controllers\LabelController@update_label')->name('update.label');
Route::post('/label-update', 'App\Http\Controllers\LabelController@on_change_new_label_update')->name('select.new.label.update');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/filters', [\App\Http\Controllers\LiveStream\LiveStreamController::class,'filtes']);
    Route::get('/logout', 'App\Http\Controllers\UserController@logout')->name('logout');
    Route::post('message', [\App\Http\Controllers\MessageController::class, 'broadcast']);
    Route::get('message/{id}', [\App\Http\Controllers\MessageController::class, 'lists']);
    Route::get('user-lists', [\App\Http\Controllers\MessageController::class, 'userLists']);

    Route::get('livestream/{id}', [\App\Http\Controllers\UserLiveStreamController::class, 'index']);
    Route::post('livestream-user', [\App\Http\Controllers\UserLiveStreamController::class, 'store']);

    // live stream
    Route::get('/stream/start', [\App\Http\Controllers\LiveStream\LiveStreamController::class, 'showStartStreamForm'])
        ->name('stream.form.index');
    Route::post('/stream', [\App\Http\Controllers\LiveStream\LiveStreamController::class, 'createNewStream'])
        ->name('stream.form.submit');
    Route::post('/streamstop', [\App\Http\Controllers\LiveStream\LiveStreamController::class, 'stopStream'])
        ->name('stream.form.stop.submit');
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/stream/{id}', [\App\Http\Controllers\LiveStream\LiveStreamController::class, 'showStream'])
            ->name('stream.live');
    });

    Route::get('/streams/{id}', 'App\Http\Controllers\StreamController@index')->name('specific_stream');

    Route::group(['middleware' => 'role'], function () {

        Route::post('add-delay-time', [\App\Http\Controllers\LiveStream\LiveStreamController::class,'delayTime']);
        Route::get('/dashboard', function () {
            return view('backend.dashboard');
        })->name('dashboard');

        Route::get('/livestreams/{type}', [\App\Http\Controllers\Admin\LiveStreamn\LiveStreamIndex::class, 'index']);
        Route::get('/chat-lists', [\App\Http\Controllers\Admin\ChatController::class, 'index']);

        Route::get('/filter-word-lists', [\App\Http\Controllers\Admin\FilterController::class, 'index']);
        Route::post('/upload-filters', [\App\Http\Controllers\Admin\FilterController::class, 'store']);
        Route::delete('/delete-filters', [\App\Http\Controllers\Admin\FilterController::class, 'destroy']);
        Route::get('/download-spam-word', [\App\Http\Controllers\Admin\FilterController::class, 'export']);

        Route::post('/change-status', [\App\Http\Controllers\Admin\UserController::class, 'changeStatus']);


        Route::get('/check-url', [\App\Http\Controllers\Admin\LiveStreamn\LiveStreamIndex::class,'check123']);

        Route::post('/streams-delete', [\App\Http\Controllers\Admin\LiveStreamn\LiveStreamIndex::class,'destroy']);

        Route::post('/streams-delete', [\App\Http\Controllers\Admin\LiveStreamn\LiveStreamIndex::class,'destroy']);

        Route::get('/streaming-report', [\App\Http\Controllers\Admin\LiveStreamn\LiveStreamIndex::class,'showReport']);
        Route::get('/twitch-report', [\App\Http\Controllers\Admin\LiveStreamn\LiveStreamIndex::class,'show_twitch_report']);


        Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index']);
        Route::get('/admin-lists', [\App\Http\Controllers\Admin\UserController::class, 'admin']);

        Route::get('/roles', [\App\Http\Controllers\Admin\RoleController::class, 'index']);
        Route::get('/create-role', [\App\Http\Controllers\Admin\RoleController::class, 'create']);
        Route::post('/store-role', [\App\Http\Controllers\Admin\RoleController::class, 'store']);
        Route::get('/edit-role/{id}', [\App\Http\Controllers\Admin\RoleController::class, 'edit']);
        Route::post('/update-role/{id}', [\App\Http\Controllers\Admin\RoleController::class, 'update']);
        Route::post('/delete-role', [\App\Http\Controllers\Admin\RoleController::class,'destroy']);

        Route::post('/add-user-roles', [\App\Http\Controllers\Admin\UserController::class,'addRoles']);

        Route::post('add-user-livestreams', [\App\Http\Controllers\Admin\UserController::class,'addLivestream']);

        // start code by sangita - 11-03-23  admin side menu
        Route::get('/setting', [\App\Http\Controllers\Admin\SettingController::class, 'index']);
        Route::put('/save-setting', [\App\Http\Controllers\Admin\SettingController::class, 'saveSetting']);

        Route::get('/betting/list', [\App\Http\Controllers\Admin\BettingController::class, 'getBettingList']);
        Route::get('/betting/add', [\App\Http\Controllers\Admin\BettingController::class, 'add']);
        Route::get('/betting/update/{id}', [\App\Http\Controllers\Admin\BettingController::class, 'editBetting']);
        Route::put('/update-betting/{id}', [\App\Http\Controllers\Admin\BettingController::class, 'updateBetting']);
        Route::put('/save-betting', [\App\Http\Controllers\Admin\BettingController::class, 'saveBetting']);
        Route::get('/betting/delete/{id}', [\App\Http\Controllers\Admin\BettingController::class, 'destroy']);

        Route::get('/bettingview/list', [\App\Http\Controllers\Admin\BettingViewController::class, 'getBettingViewList']);
        Route::get('/bettingview/add', [\App\Http\Controllers\Admin\BettingViewController::class, 'add']);
        Route::get('/bettingview/update/{id}', [\App\Http\Controllers\Admin\BettingViewController::class, 'editBettingView']);
        Route::put('/update-bettingview/{id}', [\App\Http\Controllers\Admin\BettingViewController::class, 'updateBettingView']);
        Route::put('/save-bettingview', [\App\Http\Controllers\Admin\BettingViewController::class, 'saveBettingView']);
        Route::get('/bettingview/delete/{id}', [\App\Http\Controllers\Admin\BettingViewController::class, 'destroy']);

    });

    Route::post('/save-new_main_bet', [App\Http\Controllers\BetController::class, 'saveNewBet']);
    Route::post('/calculate_vig', [App\Http\Controllers\BetController::class, 'calculateVig']);
    Route::post('/set_win_result', [App\Http\Controllers\BetController::class, 'setDeclaredResult']);
    Route::post('/claim_bet', [App\Http\Controllers\BetController::class, 'setClaimBet']);

    Route::get('/report/active_bet_list/{id}', [\App\Http\Controllers\Admin\ReportController::class, 'getActiveBetList']);
    Route::get('/report/better_list/{id}', [\App\Http\Controllers\Admin\ReportController::class, 'getBetterList']);
    Route::get('/my_bettings', [\App\Http\Controllers\MyBetsController::class, 'getMyBettingList'])->name('my_bettings');
    Route::get('/stream_bet/{id}', [\App\Http\Controllers\MyStreamsController::class, 'getMyStreamBettingList']);
    Route::post('/transfer_to_paypal', [\App\Http\Controllers\PaypalController::class, 'transferMoneyToPaypal']);
    Route::post('/transfer_paypal_to_wallet', [\App\Http\Controllers\PaypalController::class, 'transferMoneyPaypalToWallet']);
    Route::get('/my_transcation', [\App\Http\Controllers\MyBetsController::class, 'getMyTransactionList'])->name('my_transactions');


    Route::get('/streams/show/{id}', 'App\Http\Controllers\StreamController@show');



});
