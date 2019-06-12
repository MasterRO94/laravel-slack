<?php

namespace App\Http\Controllers;

use App\RequestBody\Json\Attachment;
use App\RequestBody\Json\AttachmentAction;
use App\RequestBody\Json\JsonBody;
use App\RequestBody\Multipart\FileItem;
use GuzzleHttp\Client;

class TempController extends Controller
{
    public function sendMessageOne()
    {
        $client = new Client();
        $token = config('laravel-slack-plugin.token');
        $channelId = 'UHRA12K6F';

//        TODO: BUILDER

        $jsonBody = new JsonBody();
        $jsonBody->setChannel($channelId)
                 ->setReplaceOriginal(true)
                 ->setAsUser(false);
        $attachment = new Attachment();
        $attachment->setCallbackId('clbck-one')
                   ->setFallback('Fallback text')
                   ->setType('default');
        $action1 = new AttachmentAction();
        $action1->setType('button')
                ->setName('temp-name')
                ->setText('Accept')
                ->setValue(1);
        $action2 = new AttachmentAction();
        $action2->setType('button')
                ->setName('temp-name')
                ->setText('Decline')
                ->setValue(0);
        $attachment->addAction($action1)->addAction($action2);
        $jsonBody->addAttachment($attachment);

        $response = $client->request('POST', 'https://slack.com/api/chat.postMessage', [
            'headers' => [
                'Content-type'  => 'application/json',
                'Authorization' => "Bearer {$token}",
            ],
            'json'    => $jsonBody->toArray()
        ]);

    }

    public function sendMessageTwo()
    {
        $client = new Client();
        $token = config('laravel-slack-plugin.token');
        $channelId = 'UHRA12K6F';

        $jsonBody = new JsonBody();
        $jsonBody->setChannel($channelId)
                 ->setReplaceOriginal(true)
                 ->setAsUser(false);

        $attachment = new Attachment();
        $attachment->setCallbackId('clbck-one')
                   ->setFallback('Fallback text')
                   ->setType('default');
        $action1 = new AttachmentAction();
        $action1->setType('button')
                ->setName('temp-name')
                ->setText('Accept')
                ->setValue(1);
        $action2 = new AttachmentAction();
        $action2->setType('button')
                ->setName('temp-name')
                ->setText('Decline')
                ->setValue(0);
        $attachment->addAction($action1)->addAction($action2);
        $jsonBody->addAttachment($attachment);

        $response = $client->request('POST', 'https://slack.com/api/chat.postMessage', [
            'headers' => [
                'Content-type'  => 'application/json',
                'Authorization' => "Bearer {$token}",
            ],
            'json'    => $jsonBody->toArray(),
        ]);
    }

    public function sendMessageFiles()
    {
        $client = new Client();
        $token = config('laravel-slack-plugin.token');
        $channelId = 'UHRA12K6F';

        $fileItem = new FileItem();
        $fileItem->setChannels($channelId)
                 ->setFileName('temp-file-name')
                 ->setFilePath('http://www.africau.edu/images/default/sample.pdf');

        $client->request(
            'POST',
            'https://slack.com/api/files.upload',
            [
                'headers'   => [
                    'Authorization' => "Bearer {$token}",
                ],
                'multipart' => $fileItem->toArray(),
            ]
        );
    }
}
