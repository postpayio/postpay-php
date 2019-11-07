<?php

namespace Postpay\HttpClients;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;

use Postpay\Exceptions\PostpayException;
use Postpay\Http\Request;
use Postpay\Http\Response;

class GuzzleClient implements ClientInterface
{
    /**
     * @var GuzzleHttpClient The Guzzle client.
     */
    protected $client;

    /**
     * @param GuzzleHttpClient|null $client The Guzzle client.
     */
    public function __construct(GuzzleHttpClient $client = null)
    {
        $this->client = $client ?: new GuzzleHttpClient();
    }

    /**
     * @inheritdoc
     */
    public function send(Request $request, $timeout)
    {
        $options = [
            'auth' => $request->getAuth(),
            'headers' => $request->getHeaders(),
            'http_errors' => false,
            'timeout' => $timeout,
            'connect_timeout' => 10,
            RequestOptions::JSON => $request->json(),
        ];
        try {
            $response = $this->client->request(
                $request->getMethod(),
                $request->getUrl(),
                $options
            );
        } catch (RequestException $e) {
            throw new PostpayException($e->getMessage(), $e->getCode());
        }
        $headers = $response->getHeaders();
        $body = $response->getBody();
        $statusCode = $response->getStatusCode();
        return new Response($request, $statusCode, $headers, $body);
    }
}
