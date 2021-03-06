<?php

namespace Postpay\Tests\Http;

use PHPUnit\Framework\TestCase;
use Postpay\Exceptions\RESTfulException;
use Postpay\Http\Request;
use Postpay\Http\Response;

class ResponseTest extends TestCase
{
    protected $request;

    protected function setUp()
    {
        $this->request = new Request('GET');
    }

    public function testGetRequest()
    {
        $response = new Response($this->request);

        self::assertSame($this->request, $response->getRequest());
    }

    public function testGetStatusCode()
    {
        $response = new Response($this->request, 200);
        self::assertSame(200, $response->getStatusCode());
    }

    public function testGetHeaders()
    {
        $headers = ['test' => true];
        $response = new Response($this->request, 200, $headers);

        self::assertSame($headers, $response->getHeaders());
    }

    public function testJson()
    {
        $json = ['test' => true];
        $response = new Response($this->request, 200, [], json_encode($json));

        self::assertSame($json, $response->json());
    }

    public function testIsError()
    {
        $body = json_encode([RESTfulException::ERROR_KEY => true]);
        $response = new Response($this->request, 400, [], $body);

        self::assertTrue($response->isError());

        self::assertInstanceOf(
            RESTfulException::class,
            $response->getThrownException()
        );
    }

    public function testDecodeNonJson()
    {
        $response = new Response($this->request, 200, [], '-');

        self::assertEmpty($response->json());
    }
}
