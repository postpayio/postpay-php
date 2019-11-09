<p align="center">
  <a href="https://github.com/postpayio/postpay-php/releases"><img src="https://img.shields.io/github/release/postpayio/postpay-php.svg" alt="Latest Version" /></a> <a href="https://travis-ci.org/postpayio/postpay-php"><img src="https://img.shields.io/travis/postpayio/postpay-php.svg" alt="Build Status" /></a> <a href="https://scrutinizer-ci.com/g/postpayio/postpay-php/"><img src="https://scrutinizer-ci.com/g/postpayio/postpay-php/badges/quality-score.png?b=master" alt="Scrutinizer" /></a> <a href="https://scrutinizer-ci.com/g/postpayio/postpay-php/"><img src="https://scrutinizer-ci.com/g/postpayio/postpay-php/badges/coverage.png?b=master" alt="Coverage" /></a>
</p>

# Postpay, PHP HTTP client

## Installation

The recommended way to install *Postpay* is through [Composer](http://getcomposer.org):
```sh
composer require postpay/postpay-php
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

## Usage

```php
require 'vendor/autoload.php';

use Postpay\Exceptions\RESTfulException;

$config = array(
    'merchant_id' => 'id_<merchant_id>',
    'secret_key' => 'sk_live_<secret_key>',
);

$postpay = new \Postpay\Postpay($config);

try {
    $response = $postpay->get('/orders');
} catch (RESTfulException $e) {
    echo $e->getMessage();
    exit;
}
print_r($response->json());
```

## GraphQL

```php
use Postpay\Exceptions\GraphQLException;

$postpay = new \Postpay\Postpay($config);

$query = <<<'QUERY'
query OrderList($status: String!) {
  orders(status: $status) {
    edges {
      node {
        orderId
      }
    }
  }
}
QUERY;

$variables = [
    'status': 'captured',
];

try {
    $response = $postpay->query($query, $variables);
} catch (GraphQLException $e) {
    echo $e->getMessage();
    exit;
}
print_r($response->json());
```

## Sandbox

```php
$config = array(
    'sandbox' => true,
    'merchant_id' => 'id_<merchant_id>',
    'secret_key' => 'sk_test_<secret_key>',
);

$postpay = new \Postpay\Postpay($config);
```
