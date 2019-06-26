<?php

namespace Pdffiller\LaravelSlack\Services;

use GuzzleHttp\Client;
use Illuminate\Config\Repository;
use Illuminate\Support\Arr;
use Pdffiller\LaravelSlack\AvailableMethods\AbstractMethodInfo;

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
    public function post(AbstractMethodInfo $method, array $body): array
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

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}
