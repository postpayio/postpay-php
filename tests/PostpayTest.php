<?php

namespace Postpay\Tests;

use PHPUnit\Framework\TestCase;
use Postpay\Http\Request;
use Postpay\Http\Response;
use Postpay\HttpClients\ClientInterface;
use Postpay\Postpay;

class PostpayTest extends TestCase
{
    protected $config = [
        'merchant_id' => 'id',
        'secret_key' => 'sk',
    ];

    protected function mockClient()
    {
        $client = $this->createMock(ClientInterface::class);

        $client->method('send')->willReturnCallback(
            function (Request $request) {
                return new Response($request);
            }
        );
        $config = array_merge($this->config, ['client' => $client]);
        return new Postpay($config);
    }

    public function testGet()
    {
        $response = $this->mockClient()->get('/');
        self::assertEquals('GET', $response->getRequest()->getMethod());
    }

    public function testPost()
    {
        $response = $this->mockClient()->post('/');
        self::assertEquals('POST', $response->getRequest()->getMethod());
    }

    public function testPut()
    {
        $response = $this->mockClient()->put('/');
        self::assertEquals('PUT', $response->getRequest()->getMethod());
    }

    public function testPatch()
    {
        $response = $this->mockClient()->patch('/');
        self::assertEquals('PATCH', $response->getRequest()->getMethod());
    }

    public function testDelete()
    {
        $response = $this->mockClient()->delete('/');
        self::assertEquals('DELETE', $response->getRequest()->getMethod());
    }

    public function testQuery()
    {
        $response = $this->mockClient()->query('{}');
        self::assertEquals('POST', $response->getRequest()->getMethod());
    }
}
