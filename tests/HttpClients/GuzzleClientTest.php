<?php

namespace Postpay\Tests\HttpClients;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use PHPUnit\Framework\TestCase;
use Postpay\Exceptions\PostpayException;
use Postpay\Http\Request;
use Postpay\HttpClients\GuzzleClient;

class GuzzleClientTest extends TestCase
{
    public function testSend()
    {
        $mock = new MockHandler([
            new GuzzleResponse(200),
            new RequestException('error', new GuzzleRequest('GET', ''))
        ]);
        $guzzleClient = new Client(['handler' => HandlerStack::create($mock)]);
        $client = new GuzzleClient($guzzleClient);
        $request = new Request('GET');

        $response = $client->send($request);
        self::assertSame(200, $response->getStatusCode());

        $this->expectException(PostpayException::class);
        $client->send($request);
    }
}
