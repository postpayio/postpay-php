<?php

namespace Postpay\Tests\Http;

use PHPUnit\Framework\TestCase;
use Postpay\Exceptions\RESTfulException;
use Postpay\Http\Request;
use Postpay\Http\Response;

class ApiExceptionTest extends TestCase
{
    public function testGetResponse()
    {
        $request = new Request('GET');
        $response = new Response($request);
        $exc = new RESTfulException($response);

        self::assertSame($response, $exc->getResponse());
    }
}
