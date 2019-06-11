<?php

namespace App\Handlers;

use Illuminate\Support\Arr;

/**
 * Class TempHandlerOne
 *
 * @package App\Handlers
 */
class TempHandlerOne extends BaseHandler
{
    /**
     * @return bool
     */
    public function shouldBeHandled()
    {
        $payload = json_decode($this->request->get('payload'), true);
        $callBackId = Arr::get($payload, 'callback_id');
        return $callBackId === 'clbck-one';
    }

    public function handle()
    {
        logger('Logged in TempHandlerOne');
    }
}
