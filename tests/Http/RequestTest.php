<?php

namespace Postpay\Tests\Http;

use PHPUnit\Framework\TestCase;
use Postpay\Http\Request;
use Postpay\Postpay;

class RequestTest extends TestCase
{
    public function testGetMethod()
    {
        $request = new Request('get');
        self::assertEquals('GET', $request->getMethod());
    }

    public function testGetPath()
    {
        $request = new Request('GET', '/');
        self::assertEquals('/', $request->getPath());
    }

    public function testAuth()
    {
        $request = new Request('GET');
        $auth = ['user', 'password'];
        $request->setAuth($auth);

        self::assertEquals($auth, $request->getAuth());
    }

    public function testHeaders()
    {
        $request = new Request('GET');
        $headers = ['Test' => true];
        $request->setHeaders($headers);

        self::assertArraySubset($headers, $request->getHeaders());
    }

    public function testParams()
    {
        $request = new Request('GET');
        $params = ['test' => true];
        $request->setParams($params);

        self::assertArraySubset($params, $request->getParams());
    }

    public function testJson()
    {
        $request = new Request('GET');
        $params = ['test' => true];

        $request->setParams($params);
        self::assertEmpty($request->json());

        $request->setMethod('POST');
        self::assertNotEmpty($request->json());
    }

    public function testApiVersion()
    {
        $request = new Request('GET');
        $version = 'v1';
        $request->setApiVersion($version);

        self::assertEquals($version, $request->getApiVersion());
    }

    public function testIsGraphQL()
    {
        $request = new Request('GET');
        self::assertFalse($request->isGraphQL());

        $request->setApiVersion(Postpay::GRAPHQL_VERSION);
        self::assertTrue($request->isGraphQL());
    }

    public function testGetUrl()
    {
        $path = '/test';
        $request = new Request('GET', $path);

        self::assertStringEndsWith($path, $request->getUrl());
    }
}
