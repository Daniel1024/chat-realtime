<?php

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

use App\Events\MessagePosted;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('chat', function () {
        return view('chat');
    })->name('chat');

    Route::get('messages', function () {
        return \App\Message::with('user')->newQuery()->get();
    });

    Route::post('message', function (\Illuminate\Http\Request $request) {

        $message = \App\Message::query()
            ->create([
                'message'   => $request->get('message'),
                'user_id'   => auth()->id(),
            ]);

        // Announce that a new message has been posted
        broadcast(new MessagePosted($message, auth()->user()))->toOthers();

        return [
            'message'   => $message->message,
            'user'      => ['name' => auth()->user()->name],
        ];
    });
});
