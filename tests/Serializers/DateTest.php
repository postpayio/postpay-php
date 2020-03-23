<?php

namespace Postpay\Tests\Serializers;

use DateTime;
use PHPUnit\Framework\TestCase;
use Postpay\Serializers\Date;

class DateTest extends TestCase
{
    public function testFromDateTime()
    {
        $datetime = new DateTime();
        $date = Date::fromDateTime($datetime);

        self::assertGreaterThan($date->toDateTime(), $datetime);
    }

    public function testFromDate()
    {
        $datetime = new DateTime();
        $date = Date::fromDate($datetime);
        
        self::assertGreaterThan($date->toDateTime(), $datetime);
    }

    public function testJsonSerialize()
    {
        $datetime = new DateTime();
        $date = Date::fromDateTime($datetime);
        
        self::assertEquals(
            $date->jsonSerialize(),
            trim(json_encode($date), '"')
        );
    }
}
