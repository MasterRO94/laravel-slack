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
    public function getName()
    {
        return 'chat.postMessage';
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return self::POST_METHOD;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return 'https://slack.com/api/chat.postMessage';
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return [
            'Content-type'  => 'application/json',
            'Authorization' => "",
        ];
    }

    /**
     * @return string
     */
    public function getBodyType()
    {
        return self::JSON_BODY_TYPE;
    }
}
