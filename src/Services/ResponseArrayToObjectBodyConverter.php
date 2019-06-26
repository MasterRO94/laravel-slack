<?php

namespace Pdffiller\LaravelSlack\Services;

use Pdffiller\LaravelSlack\RequestBody\Json\Attachment;
use Pdffiller\LaravelSlack\RequestBody\Json\AttachmentAction;
use Pdffiller\LaravelSlack\RequestBody\Json\AttachmentField;
use Pdffiller\LaravelSlack\RequestBody\Json\JsonBodyObject;
use Illuminate\Support\Arr;

/**
 * Convert response from array to object after chat.postMessage call
 *
 * Class ArrayToObjectBodyConverter
 *
 * @package App\Services
 */
class ResponseArrayToObjectBodyConverter
{
    /**
     * @param array $data
     *
     * @return \Pdffiller\LaravelSlack\RequestBody\Json\JsonBodyObject
     */
    public function convert(array $data)
    {
        $jsonObject = new JsonBodyObject();
        $jsonObject->setChannel(Arr::get($data, 'channel'));
        $jsonObject->setTs(Arr::get($data, 'ts'));

        $message = Arr::get($data, 'message');
        $jsonObject->setText(Arr::get($message, 'text'));

        $attachments = Arr::get($message, 'attachments');
        $this->processAttachments($jsonObject, $attachments);

        return $jsonObject;
    }

    /**
     * @param \Pdffiller\LaravelSlack\RequestBody\Json\JsonBodyObject $object
     * @param array $attachments
     */
    private function processAttachments(JsonBodyObject $object, array $attachments)
    {
        foreach ($attachments as $item) {
            $attachment = new Attachment();
            $attachment->setCallbackId(Arr::get($item, 'callback_id'));
            $attachment->setFallback(Arr::get($item, 'fallback'));
            $attachment->setText(Arr::get($item, 'text'));
            $attachment->setColor(Arr::get($item, 'color'));

            $fields = Arr::get($item, 'fields');
            if ($fields) {
                $this->processFields($attachment, $fields);
            }

            $actions = Arr::get($item, 'actions');
            if ($actions) {
                $this->processActions($attachment, $actions);
            }

            $object->addAttachment($attachment);
        }
    }

    /**
     * @param \App\RequestBody\Json\Attachment $attachment
     * @param array $fields
     */
    private function processFields(Attachment $attachment, array $fields)
    {
        foreach ($fields as $item) {
            $field = new AttachmentField();
            $field->setTitle(Arr::get($item, 'title'));
            $field->setValue(Arr::get($item, 'value'));
            $field->setShort(Arr::get($item, 'short'));
            $attachment->addField($field);
        }
    }

    /**
     * @param \Pdffiller\LaravelSlack\RequestBody\Json\Attachment $attachment
     * @param array $actions
     */
    private function processActions(Attachment $attachment, array $actions)
    {
        foreach ($actions as $item) {
            $action = new AttachmentAction();
            $action->setName(Arr::get($item, 'name'));
            $action->setText(Arr::get($item, 'text'));
            $action->setType(Arr::get($item, 'type'));
            $action->setValue(Arr::get($item, 'value'));
            $action->setStyle(Arr::get($item, 'style'));
            $attachment->addAction($action);
        }
    }
}
