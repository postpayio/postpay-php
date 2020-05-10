Sandbox
=======

Set ``sandbox`` config variable to ``true`` for sandbox requests:

.. code-block:: php

    $postpay = new \Postpay\Postpay([
        'sandbox' => true,
        'merchant_id' => 'id_ ...',
        'secret_key' => 'sk_test_ ...',
    ]);

Please, remember that test secret key starts with ``sk_test``.

For more information about *Testing API*, see `API Docs <https://docs.postpay.io/v1/#testing>`__.
