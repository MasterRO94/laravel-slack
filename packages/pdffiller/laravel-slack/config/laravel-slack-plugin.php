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

    /*
     * Slack Api Methods which are available in plugin
     */
    'methods' => [
        'POST' => [
            'chat.postMessage' => [
                'url'       => 'https://slack.com/api/chat.postMessage',
                'headers'   => [
                    'Content-type'  => 'application/json',
                    'Authorization' => "",
                ],
                'body-type' => 'json',
            ],
            'chat.update'      => [
                'url'       => 'https://slack.com/api/chat.update',
                'headers'   => [
                    'Content-type'  => 'application/json',
                    'Authorization' => "",
                ],
                'body-type' => 'json',
            ],
            'dialog.open'      => [
                'url'       => 'https://slack.com/api/dialog.open',
                'headers'   => [
                    'Content-type'  => 'application/json',
                    'Authorization' => "",
                ],
                'body-type' => 'json',
            ],
            'files.upload'     => [
                'url'       => 'https://slack.com/api/files.upload',
                'headers'   => [
                    'Authorization' => "",
                ],
                'body-type' => 'multipart',
            ],
        ],
    ],
];
