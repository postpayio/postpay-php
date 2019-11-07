<?php

namespace Postpay\Http;

use Postpay\Postpay;

class Request
{
    /**
     * @const string API URL.
     */
    const API_URL = 'https://<subdomain>.postpay.io';

    /**
     * @const string Accept HTTP header.
     */
    const ACCEPT_HEADER = 'application/vnd.postpay+json; version=';

    /**
     * @var string The HTTP method.
     */
    protected $method;

    /**
     * @var string The path URL.
     */
    protected $path;

    /**
     * @var array The basic auth credentials.
     */
    protected $auth;

    /**
     * @var array The headers to send with the request.
     */
    protected $headers = [];

    /**
     * @var array The parameters to send with the request.
     */
    protected $params = [];

    /**
     * @var string API version.
     */
    protected $apiVersion;

    /**
     * @var bool Set to true for sandbox request.
     */
    protected $sandbox;

    /**
     * Creates a new Request entity.
     *
     * @param string|null $method
     * @param string|null $path
     * @param array|null  $params
     * @param array|null  $auth
     * @param bool        $sandbox
     */
    public function __construct(
        $method = null,
        $path = null,
        array $params = [],
        $auth = null,
        $apiVersion = null,
        $sandbox = false
    ) {
        $this->auth = $auth;
        $this->setMethod($method);
        $this->path = $path;
        $this->params = $params;
        $this->apiVersion = $apiVersion ?: Postpay::DEFAULT_API_VERSION;
        $this->sandbox = $sandbox;
    }

    /**
     * Return the basic auth credentials.
     *
     * @return array|null
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * Return the HTTP method.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set the HTTP method.
     *
     * @param string
     */
    public function setMethod($method)
    {
        $this->method = strtoupper($method);
    }

    /**
     * Return the path URL.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Generate and return HTTP headers.
     *
     * @return array
     */
    public function getHeaders()
    {
        return array_merge($this->headers, $this->getDefaultHeaders());
    }

    /**
     * Set the headers.
     *
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = array_merge($this->headers, $headers);
    }

    /**
     * Return the default headers.
     *
     * @return array
     */
    public function getDefaultHeaders()
    {
        return [
            'Accept-Encoding' => '*',
            'Accept' => static::ACCEPT_HEADER . $this->apiVersion,
            'Content-Type' => 'application/json',
            'User-Agent' => 'postpay-php:' . Postpay::VERSION,
        ];
    }

    /**
     * Return the params.
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Return JSON params on POST requests.
     *
     * @return array
     */
    public function json()
    {
        if ($this->method !== 'GET') {
            return $this->params;
        }
        return [];
    }

    /**
     * The API version.
     *
     * @return string
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    /**
     * Return true if it's a GraphQL request.
     *
     * @return bool
     */
    public function isGraphQL()
    {
        return $this->apiVersion === Postpay::GRAPHQL_VERSION;
    }

    public function getApiUrl()
    {
        $subdomain = $this->sandbox ? 'sandbox' : 'api';
        return str_replace('<subdomain>', $subdomain, static::API_URL);
    }

    /**
     * Generate and return the URL.
     *
     * @return string
     */
    public function getUrl()
    {
        $path = Url::slashPrefix($this->path);

        if ($this->method === 'GET') {
            $path = Url::addParamsToUrl($path, $this->params);
        }
        return $this->getApiUrl() . $path;
    }
}
