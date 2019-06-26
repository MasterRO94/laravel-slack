<?php

return [
    /*
     * OAuth Access Token from Slack App
     */
    'user-token' => env('SLACK_USER_TOKEN', null),

    /*
     * Bot User OAuth Access from Slack App
     */
    'bot-token' => env('SLACK_BOT_TOKEN', null),

    /*
     * Verification token from Slack App
     */
    'verification_token' => env('SLACK_VERIFICATION_TOKEN', null),

    /*
     * Handlers are processed by controller
     */
    'handlers' => [
    ],
];
