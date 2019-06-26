<?php

namespace Pdffiller\LaravelSlack\Handlers;

/**
 * Interface BaseHandleInterface
 *
 * @package App\Handlers
 */
interface BaseHandleInterface
{
    public function shouldBeHandled();

    public function handle();
}
