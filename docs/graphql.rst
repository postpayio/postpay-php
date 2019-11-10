GraphQL
=======

For information about Postpay's GraphQL API, see the `API documentation <https://docs.postpay.io/graphql>`__.

Usage
-----

.. code-block:: php

    use Postpay\Exceptions\GraphQLException;

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
        print_r($e->getErrors());
        exit;
    }
    print_r($response->json());

Create Checkout
---------------

For more information about *Create Checkout* and how to define the ``$input`` variable, see `API docs <https://docs.postpay.io/graphql/#create-a-checkout>`__.

.. code-block:: php

    $query = <<<'MUTATION'
    mutation CreateCheckout($input: CreateCheckoutInput!) {
      createCheckout(input: $input) {
        token
        expires
        redirectUrl
      }
    }
    MUTATION;

    $variables = [
        'input' => $input,
    ];

    try {
        $response = $postpay->query($query, $variables);
    } catch (GraphQLException $e) {
        print_r($e->getErrors());
        exit;
    }
    echo $response->json()['createCheckout']['redirectUrl'];

Capture
-------

For more information about *Capture*, see `API docs <https://docs.postpay.io/graphql/#capture>`__.

.. code-block:: php

    $query = <<<'MUTATION'
    mutation Capture($input: CaptureInput!) {
      capture(input: $input) {
        order {
          status
        }
      }
    }
    MUTATION;

    $variables = [
        'input' => ['orderId' => 'order-01'],
    ];

    try {
        $response = $postpay->query($query, $variables);
    } catch (GraphQLException $e) {
        print_r($e->getErrors());
        exit;
    }
    print_r($response->json());

Refund
------

For more information about *Refund*, see `API docs <https://docs.postpay.io/graphql/#refund>`__.

.. code-block:: php

    $query = <<<'MUTATION'
    mutation Refund($input: RefundInput!) {
      refund(input: $input) {
        order {
          totalAmount
          refunds {
            amount
          }
        }
      }
    }
    MUTATION;

    $variables = [
        'input' => [
            'orderId' => 'order-01',
            'refundId' => 'refund-01',
            'amount' => 2050,
            'description' => 'Item returned by user',
        ],
    ];

    try {
        $response = $postpay->query($query, $variables);
    } catch (GraphQLException $e) {
        print_r($e->getErrors());
        exit;
    }
    print_r($response->json());
