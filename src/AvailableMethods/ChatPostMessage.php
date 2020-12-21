<?php

namespace Pdffiller\LaravelSlack\AvailableMethods;

/**
 * Class ChatPostMessage
 *
 * @package Pdffiller\LaravelSlack\AvailableMethods
 */
class ChatPostMessage extends AbstractMethodInfo
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'chat.postMessage';
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return self::POST_METHOD;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return 'https://slack.com/api/chat.postMessage';
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return [
            'Content-type'  => 'application/json; charset=utf-8',
            'Authorization' => "",
        ];
    }

    /**
     * @return string
     */
    public function getBodyType(): string
    {
        return self::JSON_BODY_TYPE;
    }
}
