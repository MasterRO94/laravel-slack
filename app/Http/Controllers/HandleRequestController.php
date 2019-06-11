<?php

namespace App\Http\Controllers;

use App\Handlers\BaseHandleInterface;
use App\Handlers\BaseHandler;
use Illuminate\Config\Repository;
use Illuminate\Http\Request;

/**
 * Class HandleRequestController
 *
 * @package App\Http\Controllers
 */
class HandleRequestController extends Controller
{
    /**
     * @var \Illuminate\Support\Collection
     */
    protected $config;

    /**
     * HandleRequestController constructor.
     *
     * @param \Illuminate\Config\Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->config = collect($config->get('laravel-slack-plugin'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @throws \Exception
     */
    public function handle(Request $request)
    {
        $handler = $this->getHandler($request);
        $handler->handle();
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Handlers\BaseHandler
     * @throws \Exception
     */
    private function getHandler(Request $request): BaseHandler
    {
        $handlers = collect($this->config->get('handlers'))
            ->map(function (string $handlerClassName) use ($request) {
                if (!class_exists($handlerClassName)) {
                    throw new \Exception("Handler {$handlerClassName} does not exist");
                }

                return new $handlerClassName($request);
            });

        $handler = $handlers->filter(function (BaseHandleInterface $handler) {
            return $handler->shouldBeHandled();
        })->first();

        if (!$handler) {
            throw new \Exception("There is no handler for this request");
        }

        return $handler;
    }
}
