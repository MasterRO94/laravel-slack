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
    public function getName(): string
    {
        return 'files.upload';
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
        return 'https://slack.com/api/files.upload';
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return [
            'Authorization' => "",
        ];
    }

    /**
     * @return string
     */
    public function getBodyType(): string
    {
        return self::MULTIPART_BODY_TYPE;
    }
}
