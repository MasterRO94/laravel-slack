<?php

namespace Pdffiller\LaravelSlack\AvailableMethods;

/**
 * Class FilesUpload
 *
 * @package Pdffiller\LaravelSlack\AvailableMethods
 */
class FilesUpload extends AbstractMethodInfo
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'files.upload';
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
        return 'https://slack.com/api/files.upload';
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return [
            'Authorization' => "",
        ];
    }

    /**
     * @return string
     */
    public function getBodyType()
    {
        return self::MULTIPART_BODY_TYPE;
    }
}
