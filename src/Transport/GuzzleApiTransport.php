<?php

namespace Capusta\SDK\Transport;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7;
use GuzzleHttp\RequestOptions;
use Capusta\SDK\Exception\TransportException;

class GuzzleApiTransport extends AbstractApiTransport
{
    private $guzzleClient;

    public function __construct(GuzzleClient $guzzleClient)
    {
        parent::__construct();
        $this->guzzleClient = $guzzleClient;
    }

    /**
     * @param Psr7\Request $request
     *
     * @return Psr7\Response|\Psr\Http\Message\ResponseInterface
     *
     * @throws \Exception
     * @throws GuzzleException
     * @throws TransportException
     */
    protected function sendRequest(Psr7\Request $request)
    {
        try {
            return $this->guzzleClient->send($request, [
                RequestOptions::HTTP_ERRORS => false,
            ]);
        } catch (\Exception $e) {
            if ($e instanceof GuzzleException) {
                throw new TransportException($e->getMessage(), $e->getCode());
            }

            throw $e;
        }
    }
}
