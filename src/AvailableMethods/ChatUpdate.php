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
    public function getName()
    {
        return 'chat.update';
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
        return 'https://slack.com/api/chat.update';
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
