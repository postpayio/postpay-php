<?php

namespace Postpay\Tests\HttpClients;

use PHPUnit\Framework\TestCase;
use Postpay\Exceptions\RESTfulException;
use Postpay\Http\Request;
use Postpay\Http\Response;
use Postpay\HttpClients\Client;
use Postpay\HttpClients\ClientInterface;
use Postpay\Postpay;

class ClientTest extends TestCase
{
    public function testGetClientHandler()
    {
        $client = new Client();

        self::assertInstanceOf(
            ClientInterface::class,
            $client->getClientHandler()
        );
    }

    public function testSetClientHandler()
    {
        $client = new Client();
        $clientHandler = Postpay::createClientHandler();
        $client->setClientHandler($clientHandler);

        self::assertEquals($clientHandler, $client->getClientHandler());
    }

    public function testRequest()
    {
        $clientHandler = $this->createMock(ClientInterface::class);

        $clientHandler->method('send')->willReturnCallback(
            function (Request $request) {
                return new Response($request, 200);
            }
        );
        $client = new Client($clientHandler);

        $response = $client->request(new Request('GET'));
        self::assertSame(200, $response->getStatusCode());
    }

    public function testRequestError()
    {
        $clientHandler = $this->createMock(ClientInterface::class);

        $clientHandler->method('send')->willReturnCallback(
            function (Request $request) {
                $body = json_encode([RESTfulException::ERROR_KEY => true]);
                return new Response($request, 400, [], $body);
            }
        );
        $client = new Client($clientHandler);

        $this->expectException(RESTfulException::class);
        $client->request(new Request('GET'));
    }
}
