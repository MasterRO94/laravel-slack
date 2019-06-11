<?php

namespace App\Handlers;

use Illuminate\Support\Arr;

/**
 * Class TempHandlerTwo
 *
 * @package App\Handlers
 */
class TempHandlerTwo extends BaseHandler
{
    /**
     * @return bool
     */
    public function shouldBeHandled()
    {
        $payload = json_decode($this->request->get('payload'), true);
        $callBackId = Arr::get($payload, 'callback_id');
        return $callBackId === 'clbck-two';
    }

    public function handle()
    {
        logger('Logged in TempHandlerTwo');
    }
}
