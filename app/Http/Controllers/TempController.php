<?php

namespace App\Http\Controllers;

use App\RequestBody\Json\Attachment;
use App\RequestBody\Json\AttachmentAction;
use App\RequestBody\Json\AttachmentField;
use App\RequestBody\Json\JsonBodyObject;
use App\RequestBody\Multipart\FileItemObject;
use App\Services\ResponseArrayToObjectBodyConverter;
use App\Services\SlackApi;
use GuzzleHttp\Client;
use Monolog\Formatter\ChromePHPFormatter;

class TempController extends Controller
{
    private function getMessage()
    {
        $channelId = 'UHRA12K6F';
        $test101Id = 'GJLMZ7ER1';
//        TODO: BUILDER (?)
        $jsonBody = new JsonBodyObject();
        $jsonBody->setChannel($test101Id)
                 ->setReplaceOriginal(true)
                 ->setAsUser(true)
                 ->setText('This is basic message');

        $textAttachment = new Attachment();
        $textAttachment->setText("this is green text")
                       ->setColor('#36a64f');

        $textAttachment2 = new Attachment();
        $textAttachment2->setText("this is red text")
                        ->setColor('ff0000');

        $attachmentF = new Attachment();
        $attachmentF->setFallback('fields...');

        $field1 = new AttachmentField();
        $field1->setTitle('Company Id')
               ->setValue('124')
               ->setShort(true);

        $field2 = new AttachmentField();
        $field2->setTitle('Project Id')
               ->setValue('321')
               ->setShort(true);
        $attachmentF->addField($field1)->addField($field2);

        $attachmentA = new Attachment();
        $attachmentA->setCallbackId('clbck-one')
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
        $attachmentA->addAction($action1)->addAction($action2);

        $jsonBody->addAttachment($textAttachment)
                 ->addAttachment($textAttachment2)
                 ->addAttachment($attachmentF)
                 ->addAttachment($attachmentA);

        return $jsonBody;
    }

    public function sendMessageOne(SlackApi $api, ResponseArrayToObjectBodyConverter $converter)
    {
        // create
        $jsonBody = $this->getMessage();
        $response = $api->post('chat.postMessage', $jsonBody->toArray());

        // update
//        $object = $converter->convert($response);
//        $textAttachment = new Attachment();
//        $textAttachment->setText("this is NEEWWW text");
//        $object->getAttachments()->add($textAttachment);
//        $api->post('chat.update', $object->toArray());
    }

    public function sendMessageTwo()
    {
        $test101Id = 'GJLMZ7ER1';

        $jsonBody = new JsonBodyObject();
        $jsonBody->setChannel($test101Id)
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

        $s = resolve(SlackApi::class);
        $response = $s->post('chat.postMessage', $jsonBody->toArray());
    }

    public function sendMessageFiles()
    {
        $test101Id = 'GJLMZ7ER1';
        $fileItem = new FileItemObject();
        $fileItem->setChannels($test101Id)
                 ->setFileName('temp-file-name')
                 ->setFilePath('http://www.africau.edu/images/default/sample.pdf');

        $s = resolve(SlackApi::class);
        $response = $s->post('files.upload', $fileItem->toArray());
    }
}
