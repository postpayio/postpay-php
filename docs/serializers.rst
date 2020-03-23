Serializers
===========

Date
----

Serializes a date object to a value that can be serialized natively by `json_encode()`_.

.. code-block:: php

    use Postpay\Serializers\Date;

    $datetime = new DateTime();
    $date = Date::fromDateTime($datetime);
    
    json_encode($date);


.. code-block:: php

    use Postpay\Serializers\Date;

    $datetime = new DateTime();
    $date = Date::fromDate($datetime);
    
    json_encode($date);

Decimal
-------

Serializes a float to `decimal <https://docs.postpay.io/v1/#data-types>`__ that can be serialized natively by `json_encode()`_.

.. code-block:: php

    use Postpay\Serializers\Decimal;

    $decimal = Decimal::fromFloat(100.5);
    
    json_encode($decimal);

For further information about Postpay's API, see the `API documentation <https://docs.postpay.io>`__.

.. _json_encode(): https://www.php.net/manual/en/function.json-encode.php
