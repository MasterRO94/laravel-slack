<?php

namespace Pdffiller\LaravelSlack\AvailableMethods;

/**
 * Class AbstractMethodInfo
 *
 * @package Pdffiller\LaravelSlack\AvailableMethods
 */
abstract class AbstractMethodInfo
{
    const POST_METHOD = 'POST';
    const JSON_BODY_TYPE = 'json';
    const MULTIPART_BODY_TYPE = 'multipart';

    abstract public function getName();
    abstract public function getMethod();
    abstract public function getUrl();
    abstract public function getHeaders();
    abstract public function getBodyType();
}
