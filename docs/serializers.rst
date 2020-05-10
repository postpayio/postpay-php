Serializers
===========

Date
----

Creates a ``Date`` instance that can be serialized natively by `json_encode()`_.

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

Creates a ``Decimal`` instance that can be serialized natively by `json_encode()`_.

.. code-block:: php

    use Postpay\Serializers\Decimal;

    $decimal = Decimal::fromFloat(100.5);
    
    json_encode($decimal);

.. _json_encode(): https://www.php.net/manual/en/function.json-encode.php
