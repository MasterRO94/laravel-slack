<?php

use App\Http\Middleware\VerifySlackToken;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

/*
 * Slack app interaction
 */
Route::group([
    'middleware' => [VerifySlackToken::class],
], function () {
    Route::post('slack/handle', 'HandleRequestController@handle');
});
