<?php

namespace Postpay\Tests\Http;

use PHPUnit\Framework\TestCase;
use Postpay\Http\Url;

class UrlTest extends TestCase
{
    public function testAddParamsToUrl()
    {
        $params = ['test' => true];
        $url = Url::addParamsToUrl('/', $params);
        parse_str(parse_url($url, PHP_URL_QUERY), $result);

        self::assertEquals($params, $result);
    }

    public function testSlashPrefix()
    {
        $path = Url::slashPrefix('');
        self::assertEquals($path, '/');
    }
}
