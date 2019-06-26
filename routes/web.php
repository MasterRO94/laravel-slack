<?php

use Pdffiller\LaravelSlack\VerifySlackToken;

/*
 * Slack app interaction
 */
Route::group([
    'middleware' => [VerifySlackToken::class],
], function () {
    Route::post('slack/handle', 'Pdffiller\LaravelSlack\HandleRequestController@handle');
});
