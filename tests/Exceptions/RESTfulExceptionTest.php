<?php

namespace Postpay\Tests\Http;

use PHPUnit\Framework\TestCase;
use Postpay\Exceptions\RESTfulException;
use Postpay\Http\Request;
use Postpay\Http\Response;

class RESTfulExceptionTest extends TestCase
{
    public function testGetErrorCode()
    {
        $request = new Request('GET');
        $body = json_encode([
            RESTfulException::ERROR_KEY => [
                'code' => 'test'
            ],
        ]);
        $response = new Response($request, 400, [], $body);
        $exc = new RESTfulException($response);

        self::assertEquals('test', $exc->getErrorCode());
    }
}
