<?php

namespace Pdffiller\LaravelSlack\Services;

use GuzzleHttp\Client;
use Illuminate\Config\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Pdffiller\LaravelSlack\AvailableMethods\AbstractMethodInfo;
use Pdffiller\LaravelSlack\AvailableMethods\ChatPostMessage;
use Pdffiller\LaravelSlack\Models\LaravelSlackMessage;

/**
 * Class SlackApi
 *
 * @package App\Services
 */
class SlackApi
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $config;

    /**
     * TempService constructor.
     */
    public function __construct(Repository $config)
    {
        $this->client = new Client();
        $this->config = collect($config->get('laravel-slack-plugin'));
    }


    /**
     * @param \Pdffiller\LaravelSlack\AvailableMethods\AbstractMethodInfo $method
     * @param array $body
     * @param \Illuminate\Database\Eloquent\Model|null $model
     * @param null $options
     *
     * @return array
     */
    public function post(AbstractMethodInfo $method, array $body, Model $model = null, $options = null): array
    {
        $botToken = $this->config->get('bot-token');
        $url = $method->getUrl();
        $bodyType = $method->getBodyType();
        $headers = $method->getHeaders();
        if (array_key_exists('Authorization', $headers)) {
            $headers['Authorization'] = "Bearer {$botToken}";
        }

        $response = $this->client->request('POST', $url, [
            'headers' => $headers,
            $bodyType => $body,
        ]);

        $decodedResponse = \GuzzleHttp\json_decode($response->getBody(), true);

        if (Arr::has($decodedResponse, 'ok') && !$decodedResponse['ok']) {
            throw new \Exception('Failed to send message: ' . json_encode($decodedResponse));
        }

        if ($method instanceof ChatPostMessage) {
            $this->saveMessage($decodedResponse, $model, $options);
        }

        return $decodedResponse;
    }

    /**
     * @param array $response
     * @param \Illuminate\Database\Eloquent\Model|null $model
     * @param null $options
     */
    private function saveMessage(array $response, Model $model = null, $options = null)
    {
        $dbRecord = new LaravelSlackMessage();
        $dbRecord->ts = $response['ts'];
        $dbRecord->channel = $response['channel'];
        if ($model) {
            $dbRecord->model_id = $model->getKey();
            $dbRecord->model = get_class($model);
        }
        if ($options) {
            $dbRecord->options = $options;
        }
        $dbRecord->save();
    }
}
