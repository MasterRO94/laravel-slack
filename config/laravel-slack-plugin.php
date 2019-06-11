<?php

return [

    /*
     * OAUTH token from Slack App
     */
    'token' => env('SLACK_TOKEN', null),

    /*
     * Verification token from Slack App
     */
    'verification_token' => env('SLACK_VERIFICATION_TOKEN', null),

    /*
     * Handlers are processed by controller
     */
    'handlers' => [
        // temp testing handlers
        \App\Handlers\TempHandlerOne::class,
        \App\Handlers\TempHandlerTwo::class,
    ],
];
