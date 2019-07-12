<?php

namespace Pdffiller\LaravelSlack;

use Illuminate\Config\Repository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Pdffiller\LaravelSlack\Handlers\BaseHandleInterface;
use Pdffiller\LaravelSlack\Handlers\BaseHandler;

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
        // temp
        if ($request->has('challenge') && $request->has('type') && $request->get('type') == "url_verification") {
            return response()->json([
                'challenge' => $request->get('challenge')]);
        }
        $handler = $this->getHandler($request);
        $handler->handle();
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Pdffiller\LaravelSlack\Handlers\BaseHandler
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
