<?php

namespace Pdffiller\LaravelSlack\AvailableMethods;

/**
 * Class DialogOpen
 *
 * @package Pdffiller\LaravelSlack\AvailableMethods
 */
class DialogOpen extends AbstractMethodInfo
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'dialog.open';
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
        return 'https://slack.com/api/dialog.open';
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
