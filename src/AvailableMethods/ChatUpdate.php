<?php

namespace Pdffiller\LaravelSlack\AvailableMethods;

/**
 * Class ChatUpdate
 *
 * @package Pdffiller\LaravelSlack\AvailableMethods
 */
class ChatUpdate extends AbstractMethodInfo
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'chat.update';
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
        return 'https://slack.com/api/chat.update';
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return [
            'Content-type'  => 'application/json',
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
