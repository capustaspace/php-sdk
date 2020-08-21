<?php

namespace Capusta\SDK\Transport;


use GuzzleHttp\Psr7;
use Capusta\SDK\Client;
use Capusta\SDK\Exception\TransportException;
use Capusta\SDK\Transport\Authorization\AuthorizationInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

abstract class AbstractApiTransport implements LoggerAwareInterface
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    /**
     * Domain
     *
     * @var string
     */
    protected $apiUrl = 'https://api.capusta.space';
    protected $testApiUrl = 'https://api.stage.capusta.space';
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var boolean
     */
    protected $test;

    /**
     * @var AuthorizationInterface
     */
    protected $authorization;

    /**
     * @var string[]
     */
    protected $defaultHeaders;

    /**
     * AbstractApiTransport constructor.
     */
    public function __construct()
    {
        $this->defaultHeaders = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'User-Agent' => 'Capusta PHP SDK v' . Client::VERSION,
            'X-Client-Name' => 'PHP SDK',
            'X-Client-Version' => Client::VERSION,
        ];
    }

    /**
     * @param Psr7\Request $request
     *
     * @return Psr7\Response
     */
    abstract protected function sendRequest(Psr7\Request $request);

    /**
     * @param string $path        Название метода из api
     * @param string $method      GET или POST
     * @param array  $queryParams GET параметры
     * @param mixed  $body
     * @param array  $headers
     *
     * @return Psr7\Response
     * @throws TransportException
     */
    public function send($path, $method, $queryParams = [], $body = null, $headers = [])
    {
        if (!$this->test) {
            $uri = rtrim($this->apiUrl, '/') . '/' . ltrim($path, '/');
        } else {
            $uri = rtrim($this->testApiUrl, '/') . '/' . ltrim($path, '/');
        }
        if (is_array($queryParams) && count($queryParams)) {
            $uri .= '?' . http_build_query($queryParams);
        }
        if (!$this->authorization) {
            throw new TransportException('Please provide auth data');
        }

        $headers = array_replace($this->defaultHeaders, $headers);

        if ($method == self::METHOD_GET) {
            $body = null;
        }

        if ($this->logger) {
            $this->logger->info('Send request', [
                'method' => $method,
                'uri' => $uri,
                'body' => $body,
                'headers' => $headers,
            ]);
        }
        $headers['Authorization'] = $this->authorization->getAuthorizationHeader();
        $request = new Psr7\Request(
            $method,
            $uri,
            $headers,
            $body
        );

        return $this->sendRequest($request);
    }

    /**
     * @param string $apiUrl
     *
     * @return AbstractApiTransport
     */
    public function setApiUrl($apiUrl)
    {
        $this->apiUrl = $apiUrl;

        return $this;
    }

    /**
     * @param $test boolean
     */
    public function setTest($test) {
        $this->test = $test;
    }

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param AuthorizationInterface $authorization
     */
    public function setAuth(AuthorizationInterface $authorization, $test)
    {
        $this->authorization = $authorization;
        $this->test = $test;
    }
}
