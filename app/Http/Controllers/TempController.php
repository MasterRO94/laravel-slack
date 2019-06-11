<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class TempController extends Controller
{

    public function sendMessageOne()
    {
        $client = new Client();
        $token = config('laravel-slack-plugin.token');
        $channelId = 'UHRA12K6F';

        $response = $client->request('POST', 'https://slack.com/api/chat.postMessage', [
            'headers' => [
                'Content-type'  => 'application/json',
                'Authorization' => "Bearer {$token}",
            ],
            'json'    => [
                'as_user'          => false,
                'channel'          => $channelId,
                'replace_original' => true,
                'attachments'      => [
                    [
                        'fallback'        => 'Text',
                        'callback_id'     => 'clbck-one',
                        'color'           => '#36a64f',
                        'attachment_type' => 'default',
                        'actions'         => [
                            [
                                'type'  => 'button',
                                'name'  => 'temp-name',
                                'text'  => 'Accept',
                                'value' => 1,
                            ],
                            [
                                'type'  => 'button',
                                'name'  => 'temp-name',
                                'text'  => 'Decline',
                                'value' => 0,
                            ],
                        ],
                    ],
                ],
            ],
        ]);

    }

    public function sendMessageTwo()
    {
        $client = new Client();
        $token = config('laravel-slack-plugin.token');
        $channelId = 'UHRA12K6F';

        $response = $client->request('POST', 'https://slack.com/api/chat.postMessage', [
            'headers' => [
                'Content-type'  => 'application/json',
                'Authorization' => "Bearer {$token}",
            ],
            'json'    => [
                'as_user'          => false,
                'channel'          => $channelId,
                'replace_original' => true,
                'attachments'      => [
                    [
                        'fallback' => '',
                        'fields'   => [
                            [
                                'title' => 'Field 1',
                                'value' => 10,
                                'short' => true,
                            ],
                            [
                                'title' => 'Field 2',
                                'value' => 20,
                                'short' => true,
                            ],
                        ],
                    ],
                    [
                        'fallback'        => 'Text',
                        'callback_id'     => 'clbck-two',
                        'color'           => '#36a64f',
                        'attachment_type' => 'default',
                        'actions'         => [
                            [
                                'type'  => 'button',
                                'name'  => 'temp-name',
                                'text'  => 'Accept',
                                'value' => 1,
                            ],
                            [
                                'type'  => 'button',
                                'name'  => 'temp-name',
                                'text'  => 'Decline',
                                'value' => 0,
                            ],
                        ],
                    ],
                ],
            ],
        ]);
    }

}
