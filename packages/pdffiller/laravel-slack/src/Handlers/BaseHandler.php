<?php

namespace Pdffiller\LaravelSlack\Handlers;

use Illuminate\Http\Request;

/**
 * Class BaseHandler
 *
 * @package App\Handlers
 */
abstract class BaseHandler implements BaseHandleInterface
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * BaseHandler constructor.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    abstract public function shouldBeHandled();

    abstract public function handle();
}
