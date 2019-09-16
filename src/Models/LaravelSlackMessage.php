<?php


namespace Pdffiller\LaravelSlack\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LaravelSlackMessage
 *
 * @property int $id
 * @property string $ts
 * @property string $channel
 * @property string $model
 * @property string $model_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LaravelSlackMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LaravelSlackMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LaravelSlackMessage query()
 * @mixin \Eloquent
 */
class LaravelSlackMessage extends Model
{
    protected $table = 'laravel_slack_message';

    protected $fillable = [
        'id',
        'ts',
        'channel',
        'options',
        'model',
        'model_id',
    ];
}
