RESTful
=======

For information about Postpay's RESTful API, see the `RESTful API Docs <https://docs.postpay.io>`__.

Usage
-----

.. code-block:: php

    use Postpay\Exceptions\RESTfulException;

    $params = [
        'status' => 'captured',
    ];

    try {
        $response = $postpay->get('/orders', $params);
    } catch (RESTfulException $e) {
        echo $e->getErrorCode();
        exit;
    }
    print_r($response->json());

Create a checkout
-----------------

For more information about *Create a checkout* and how to define the ``$payload`` variable, see `API Docs <https://docs.postpay.io/v1/#create-a-checkout>`__.

.. code-block:: php

    try {
        $response = $postpay->post('/checkouts', $payload);
    } catch (RESTfulException $e) {
        echo $e->getErrorCode();
        exit;
    }
    echo $response->json()['redirect_url'];

Capture
-------

For more information about *Capture*, see `API Docs <https://docs.postpay.io/v1/#capture>`__.

.. code-block:: php

    try {
        $response = $postpay->post('/orders/$order_id/capture');
    } catch (RESTfulException $e) {
        echo $e->getErrorCode();
        exit;
    }
    print_r($response->json());

Create a refund
---------------

For more information about *Refunds*, see `API Docs <https://docs.postpay.io/v1/#refunds>`__.

.. code-block:: php

    $payload = [
        'refund_id' => 'refund-01',
        'amount' => 2050,
        'description' => 'Item returned by user',
    ];

    try {
        $response = $postpay->post('/orders/$order_id/refunds', $payload);
    } catch (RESTfulException $e) {
        echo $e->getErrorCode();
        exit;
    }
    print_r($response->json());

Create a hook
-------------

For more information about *Webhooks*, see `API Docs <https://docs.postpay.io/v1/#webhooks>`__.

.. code-block:: php

    $payload = [
        'active' => true,
        'events' => [
            'order',
        ],
        'url' => 'https://www.example.ae/hooks',
        'secret' => 'dolphins',
    ];

    try {
        $response = $postpay->post('/hooks', $payload);
    } catch (RESTfulException $e) {
        echo $e->getErrorCode();
        exit;
    }
    print_r($response->json());
