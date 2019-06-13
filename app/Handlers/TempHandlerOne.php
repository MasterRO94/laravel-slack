<?php

namespace App\Handlers;

use App\RequestBody\Json\Dialog;
use App\RequestBody\Json\DialogElement;
use App\RequestBody\Json\JsonBodyObject;
use App\Services\SlackApi;
use Illuminate\Support\Arr;

/**
 * Class TempHandlerOne
 *
 * @package App\Handlers
 */
class TempHandlerOne extends BaseHandler
{
    /**
     * @return bool
     */
    public function shouldBeHandled()
    {
        $payload = json_decode($this->request->get('payload'), true);
        $callBackId = Arr::get($payload, 'callback_id');
        return $callBackId === 'clbck-one';
    }

    public function handle()
    {
        $api =  resolve(SlackApi::class);
        $payload = json_decode($this->request->get('payload'), true);
        $triggerId = Arr::get($payload, 'trigger_id');

        $jsonObject = new JsonBodyObject();
        $jsonObject->setTriggerId($triggerId);

        $dialog = new Dialog();
        $dialog->setCallbackId('dialog-callback');
        $dialog->setTitle('Question');
        $dialog->setSubmitLabel('Save');
        $dialog->setState('some state');

        $element = new DialogElement();
        $element->setName('reason');
        $element->setLabel('.');
        $element->setType(DialogElement::TEXT_TYPE);

        $dialog->addElement($element);
        $jsonObject->setDialog($dialog);

        logger($jsonObject->toArray());

        $api->post('dialog.open', $jsonObject->toArray());
    }
}
