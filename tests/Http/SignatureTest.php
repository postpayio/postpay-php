<?php

namespace Postpay\Tests\Http;

use PHPUnit\Framework\TestCase;
use Postpay\Http\Signature;

class SignatureTest extends TestCase
{
    public function testVerify()
    {
        $timestamp = time();
        $signature = hash_hmac('sha256', "{$timestamp}:", 'secret');

        $result = Signature::verify('', "{$timestamp}:{$signature}", 'secret');
        self::assertTrue($result);
    }

    public function testVerifyHeaderError()
    {
        $result = Signature::verify('', ':', 'secret');
        self::assertFalse($result);
    }

    public function testVerifyToleranceError()
    {
        $timestamp = time() - Signature::DEFAULT_TOLERANCE - 1;
        $signature = hash_hmac('sha256', "{$timestamp}:", 'secret');

        $result = Signature::verify('', "{$timestamp}:{$signature}", 'secret');
        self::assertFalse($result);
    }
}
