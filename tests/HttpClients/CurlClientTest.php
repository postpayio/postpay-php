<?php

namespace Postpay\Tests\HttpClients;

use PHPUnit\Framework\TestCase;
use Postpay\Exceptions\PostpayException;
use Postpay\Http\Request;
use Postpay\HttpClients\Curl;
use Postpay\HttpClients\CurlClient;

class CurlClientTest extends TestCase
{
    public function testSend()
    {
        $curl = $this->createMock(Curl::class);
        $curl->method('getInfo')->willReturn(200);
        $client = new CurlClient($curl);
        $response = $client->send(new Request('GET'));

        self::assertSame(200, $response->getStatusCode());
    }

    public function testSendRequest()
    {
        $request = $this->createMock(Request::class);
        $url = 'https://postman-echo.com/basic-auth';
        $request->method('getUrl')->willReturn($url);
        $request->method('getMethod')->willReturn('GET');
        $request->method('getHeaders')->willReturn([]);
        $request->method('getAuth')->willReturn(['postman', 'password']);

        $client = new CurlClient();
        $response = $client->send($request);

        self::assertSame(200, $response->getStatusCode());
    }

    public function testSendError()
    {
        $curl = $this->createMock(Curl::class);
        $curl->method('errno')->willReturn(1);
        $client = new CurlClient($curl);

        $this->expectException(PostpayException::class);
        $response = $client->send(new Request('POST'));
    }

    public function testGetRequestHeaders()
    {
        $curl = new  CurlClient();
        $request = new Request('GET');
        $request->setHeaders(['test' => true]);
        $headers = $curl->getRequestHeaders($request);

        self::assertEquals('test: 1', $headers[0]);
    }
}
