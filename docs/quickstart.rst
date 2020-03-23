Quickstart
==========

All configs are passed around as a single variable ``config``:

.. code-block:: php

    $postpay = new \Postpay\Postpay([
        'merchant_id' => 'id_ ...',
        'secret_key' => 'sk_live_ ...',
    ]);

.. list-table:: Configuration variables
    :header-rows: 1

    * - Name
      - Type
      - Description
    * - merchant_id
      - String❗
      - Merchant ID.
    * - secret_key
      - String❗
      - The secret key.
    * - client_handler
      - String
      - The client handler, options are ``curl``, ``guzzle``. Default: ``curl``.
    * - api_version
      - String
      - The API version. Default: ``v1``.
    * - sandbox
      - Boolean
      - Set to ``true`` for sandbox requests. Default: ``false``.

A trailing exclamation mark❗is used to denote a field that uses a Non‐Null type. By default, all types are nullable.
