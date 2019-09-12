<?php

namespace Pdffiller\LaravelSlack\Services;

use GuzzleHttp\Client;
use Illuminate\Config\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Pdffiller\LaravelSlack\AvailableMethods\AbstractMethodInfo;
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
     * @param AbstractMethodInfo $method
     * @param array $body
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(AbstractMethodInfo $method, array $body, Model $model = null): array
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

        $this->saveMessage($decodedResponse, $model);

        return $decodedResponse;
    }

    /**
     * @param array $response
     * @param \Illuminate\Database\Eloquent\Model|null $model
     */
    private function saveMessage(array $response, Model $model = null)
    {
        $dbRecord = new LaravelSlackMessage();
        $dbRecord->ts = $response['ts'];
        $dbRecord->channel = $response['channel'];
        if ($model) {
            $dbRecord->model_id = $model->getKey();
            $dbRecord->model = get_class($model);
        }
        $dbRecord->save();
    }
}
