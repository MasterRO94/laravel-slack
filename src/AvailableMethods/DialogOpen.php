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
    public function getName(): string
    {
        return 'dialog.open';
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
        return 'https://slack.com/api/dialog.open';
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
