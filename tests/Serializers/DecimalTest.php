<?php

namespace Postpay\Tests\Serializers;

use PHPUnit\Framework\TestCase;
use Postpay\Serializers\Decimal;

class DecimalTest extends TestCase
{
    public function testFromFloat()
    {
        $value = mt_rand();
        $decimal = Decimal::fromFloat($value);

        self::assertSame($decimal->toFloat(), $value);
    }

    public function testJsonSerialize()
    {
        $value = mt_rand();
        $decimal = Decimal::fromFloat($value);

        self::assertEquals(
            $decimal->jsonSerialize(),
            json_encode($decimal, JSON_NUMERIC_CHECK)
        );
    }
}
