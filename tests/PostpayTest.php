<?php

namespace Postpay\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Postpay\Exceptions\PostpayException;
use Postpay\Http\Request;
use Postpay\Http\Response;
use Postpay\HttpClients\Client;
use Postpay\HttpClients\ClientInterface;
use Postpay\HttpClients\CurlClient;
use Postpay\HttpClients\GuzzleClient;
use Postpay\Postpay;

class PostpayTest extends TestCase
{
    protected $postpay;

    protected $config = [
        'merchant_id' => 'id',
        'secret_key' => 'sk',
    ];

    public function setUp()
    {
        $clientHandler = $this->createMock(ClientInterface::class);
        $clientHandler->method('send')->willReturnCallback(
            function (Request $request) {
                return new Response($request);
            }
        );
        $this->postpay = new Postpay($this->config);
        $this->postpay->setClientHandler($clientHandler);
    }

    public function testCredentialsRequired()
    {
        $this->expectException(PostpayException::class);
        new Postpay();
    }

    public function testGetClient()
    {
        self::assertInstanceOf(Client::class, $this->postpay->getClient());
    }

    public function testCreateClientHandler()
    {
        $clientHandler = $this->postpay::CreateClientHandler('curl');
        self::assertInstanceOf(CurlClient::class, $clientHandler);

        $clientHandler = $this->postpay::CreateClientHandler('guzzle');
        self::assertInstanceOf(GuzzleClient::class, $clientHandler);

        $this->expectException(InvalidArgumentException::class);
        $this->postpay::CreateClientHandler('invalid');
    }

    public function testGetLastResponse()
    {
        $response = $this->postpay->get('/');
        self::assertEquals($response, $this->postpay->getLastResponse());
    }

    public function testGet()
    {
        $response = $this->postpay->get('/');
        self::assertEquals('GET', $response->getRequest()->getMethod());
    }

    public function testPost()
    {
        $response = $this->postpay->post('/');
        self::assertEquals('POST', $response->getRequest()->getMethod());
    }

    public function testPut()
    {
        $response = $this->postpay->put('/');
        self::assertEquals('PUT', $response->getRequest()->getMethod());
    }

    public function testPatch()
    {
        $response = $this->postpay->patch('/');
        self::assertEquals('PATCH', $response->getRequest()->getMethod());
    }

    public function testDelete()
    {
        $response = $this->postpay->delete('/');
        self::assertEquals('DELETE', $response->getRequest()->getMethod());
    }

    public function testQuery()
    {
        $response = $this->postpay->query('{}');
        self::assertEquals('POST', $response->getRequest()->getMethod());
    }
}
