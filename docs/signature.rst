Verify signatures
=================

Postpay signs the webhook events it sends to your endpoints by including a signature in each event's ``X-Postpay-Signature`` header. This allows you to verify that the events were sent by Postpay, not by a third party.

.. code-block:: php

    use Postpay\Http\Signature;

    $is_valid = Signature::verify($payload, $header, $secret);

    if (!$is_valid) {
        http_response_code(403);
        exit();
    }

.. list-table::
    :header-rows: 1
    :widths: 25 20 55

    * - Parameter
      - Type
      - Description
    * - payload
      - String❗
      - The event payload.
    * - header
      - String❗
      - The HTTP ``X-Postpay-Signature`` header.
    * - secret
      - String❗
      - The *hook* secret will be used as the key to generate the HMAC hex digest.
    * - tolerance
      - Integer
      - Maximum difference allowed between the header's timestamp and the current time in order to prevent `Replay attacks <https://en.wikipedia.org/wiki/Replay_attack>`__. Default: ``300``.
