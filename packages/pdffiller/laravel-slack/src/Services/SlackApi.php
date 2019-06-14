<?php

namespace Pdffiller\LaravelSlack\Services;

use GuzzleHttp\Client;
use Illuminate\Config\Repository;
use Illuminate\Support\Arr;

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
     * @param string $method
     * @param array $body
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(string $method, array $body): array
    {
        $botToken = $this->config->get('bot-token');
        $methods = $this->config->get('methods');

        if (!array_key_exists($method, $methods['POST'])) {
            throw new \Exception("Method {$method} is not available");
        }

        $url = $methods['POST'][$method]['url'];
        $bodyType = $methods['POST'][$method]['body-type'];
        $headers = $methods['POST'][$method]['headers'];
        if (array_key_exists('Authorization', $headers)) {
            $headers['Authorization'] = "Bearer {$botToken}";
        }

        $response = $this->client->request('POST', $url, [
            'headers' => $headers,
            $bodyType => $body,
        ]);

        return json_decode($response->getBody(), true);
    }
}
