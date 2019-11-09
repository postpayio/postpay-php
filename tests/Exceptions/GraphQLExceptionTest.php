<?php

namespace Postpay\Tests\Http;

use PHPUnit\Framework\TestCase;
use Postpay\Exceptions\GraphQLException;
use Postpay\Http\Request;
use Postpay\Http\Response;

class GraphQLExceptionTest extends TestCase
{
    public function testGetErrors()
    {
        $request = new Request('GET');
        $errors = [['code' => 'test']];
        $body = json_encode([
            GraphQLException::ERROR_KEY => $errors,
        ]);
        $response = new Response($request, 400, [], $body);
        $exc = new GraphQLException($response);

        self::assertEquals($errors, $exc->getErrors());
    }
}
