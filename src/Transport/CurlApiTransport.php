<?php

namespace Capusta\SDK\Transport;


use Capusta\SDK\Exception\TransportException;
use Psr\Log\LoggerInterface;
use GuzzleHttp\Psr7;

class CurlApiTransport extends AbstractApiTransport
{
    private $curl;

    private $keepAlive = true;

    protected function sendRequest(Psr7\Request $request)
    {
        $curl = $this->getCurl();

        curl_setopt($curl, CURLOPT_URL, $request->getUri());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
//        curl_setopt($curl, CURLOPT_USERPWD, sprintf($this->username, $this->token));

        $headerList = [];
        foreach ($request->getHeaders() as $header => $value) {
            $headerList[] = sprintf('%s: %s', $header, is_array($value) ? implode(', ', $value) : (string) $value);
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headerList);

        switch ($request->getMethod()) {
            case 'GET':
                curl_setopt($curl, CURLOPT_HTTPGET, true);
                break;
            case 'POST':
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $request->getBody()->getContents());
                break;
        }

        $response = curl_exec($curl);
        $responseHeaderSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $responseCode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
        $responseHeaders = $this->parseResponseHeaders(substr($response, 0, $responseHeaderSize));
        $responseBody = substr($response, $responseHeaderSize);
        $curlError = curl_error($curl);
        $curlErrno = curl_errno($curl);
        if ($response == false) {
            switch ($curlErrno) {
                case CURLE_COULDNT_CONNECT:
                case CURLE_COULDNT_RESOLVE_HOST:
                case CURLE_OPERATION_TIMEOUTED:
                case CURLE_SSL_CACERT:
                case CURLE_SSL_PEER_CERTIFICATE:
                    $msg = 'Connection error';
                    break;
                default:
                    $msg = 'Connection error';
                    break;
            }
            if ($this->logger) {
                $this->logger->error(sprintf('CUrl error #%d: %s', $curlErrno, $curlError));
            }

            throw new TransportException($curlError, $curlErrno);
        }

        $this->closeCurl();

        return new Psr7\Response($responseCode, $responseHeaders, $responseBody);
    }

    private function parseResponseHeaders($headersString)
    {
        $result = [];
        $responseHeaders = preg_split('/(\\r?\\n)/', $headersString, -1, PREG_SPLIT_DELIM_CAPTURE);

        foreach ($responseHeaders as $header) {
            if (strpos($header, ':') === false) {
                continue;
            }
            $parts = explode(':', $header, 2);
            $key = trim($parts[0]);
            $value = isset($parts[1]) ? trim($parts[1]) : '';
            $result[$key] = $value;
        }

        return $result;
    }

    /**
     * @return resource
     */
    private function getCurl()
    {
        if (!$this->curl) {
            $this->curl = curl_init();
        }

        return $this->curl;
    }

    private function closeCurl()
    {
        if (!$this->keepAlive && $this->curl) {
            curl_close($this->curl);
            $this->curl = null;
        }
    }

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }


}