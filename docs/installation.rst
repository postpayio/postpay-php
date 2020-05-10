Installation
============

Requirements
------------

PHP 5.6.0 and later.

Composer
--------

The recommended way to install *postpay-php* is through `Composer <https://getcomposer.org/>`__::

    composer require postpay/postpay-php

After installing, you need to require Composer's autoloader:

.. code-block:: php

    require 'vendor/autoload.php';

You can then later update Postpay using composer::

    composer update

Dependencies
------------

* JSON PHP extension.
* Abstracts away the underlying HTTP transport, no hard dependency on `cURL <https://secure.php.net/manual/en/book.curl.php>`__ .
