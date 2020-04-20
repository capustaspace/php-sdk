<?php

namespace Capusta\SDK;


use Capusta\SDK\Actions\RequestCreator;
use Capusta\SDK\Exception\Notification\EmptyBearerException;
use Capusta\SDK\Exception\Notification\IncorrectBodyRequestException;
use Capusta\SDK\Exception\Notification\NotificationParseException;
use Capusta\SDK\Exception\Notification\NotificationSecurityException;
use Capusta\SDK\Model\Request\NotificationRequest;

class Notification
{
    const RESPONSE_SUCCESS = 'ok';

    const RESPONSE_ERROR = 'error';

    private $allowedIps = [
        '3.123.194.134',
    ];

    /**
     * @var string
     */
    private $merchantEmail;

    /**
     * @var string
     */
    private $token;

    /**
     * @var boolean
     */
    private $skipIpCheck = false;


    /**
     * @param string $merchantEmail
     */
    private function setMerchantEmail($merchantEmail)
    {
        $this->merchantEmail = $merchantEmail;
    }

    /**
     * @param string $token
     */
    private function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @param string $merchantEmail
     * @param string $token
     */
    public function setAuth($merchantEmail, $token)
    {
        $this->merchantEmail = $merchantEmail;
        $this->token = $token;
    }

    /**
     * @param bool $autoResponse
     *
     * @return NotificationRequest
     *
     * @throws EmptyBearerException
     * @throws NotificationSecurityException
     * @throws NotificationParseException
     * @throws IncorrectBodyRequestException
     * @throws \Exception
     */
    public function process($autoResponse = true)
    {
        try {
            $request = $this->getRequest();
            $autoResponse && $this->successResponse();
        } catch (\Exception $e) {
            $autoResponse && $this->errorResponse($e->getMessage());

            throw $e;
        }

        return $request;
    }

    public function successResponse()
    {
        $this->response(self::RESPONSE_SUCCESS);
    }

    public function errorResponse($message)
    {
        $this->response(self::RESPONSE_ERROR, $message);
    }


    /**
     * @return NotificationRequest
     *
     * @throws NotificationSecurityException
     * @throws NotificationParseException
     * @throws IncorrectBodyRequestException
     * @throws EmptyBearerException
     */
    protected function getRequest()
    {
        if (empty($this->merchantEmail) || empty($this->token)) {
            throw new EmptyBearerException('Please provide the merchantEmail & token');
        }

        $this->checkRequest();

        return $this->getRequestFromBody();
    }

    protected function response($status, $message = null)
    {
        $response = [
            'status' => $status,
        ];

        if ($message) {
            $response['message'] = $message;
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    /**
     * @return NotificationRequest
     *
     * @throws NotificationParseException
     * @throws IncorrectBodyRequestException
     */
    protected function getRequestFromBody()
    {
        $body = $this->getBody();
        throw new IncorrectBodyRequestException(json_encode($body));
        if (!is_string($body)) {
            throw new IncorrectBodyRequestException('The request body contains an invalid json');
        }

        $body = json_decode($body, true);

        if ($body === null) {
            throw new IncorrectBodyRequestException('The request body contains an invalid json');
        }

        try {
            /** @var NotificationRequest $request */
            $request = RequestCreator::create(NotificationRequest::class, $body);
        } catch (\Exception $e) {
            throw new NotificationParseException('An error occurred while parsing the request');
        }

        return $request;
    }

    /**
     * @throws NotificationSecurityException
     */
    protected function checkRequest()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) !== 'post') {
            throw new NotificationSecurityException('Only post requests are expected');
        }

        if (!$this->isIpAllowed()) {
            throw new NotificationSecurityException('Remote ip is not allowed');
        }

        if (empty($_SERVER['HTTP_X_KASSA_SIGNATURE'])) {
            throw new NotificationSecurityException('Empty signature');
        }

        $signature = strtolower($_SERVER['HTTP_X_KASSA_SIGNATURE']);
        $expectedSignature = strtolower(hash('sha256', $this->getBody() . $this->apiKey));

        if ($signature !== $expectedSignature) {
            throw new NotificationSecurityException('Incorrect signature');
        }
    }

    /**
     * @return bool|string
     */
    protected function getBody()
    {
        return file_get_contents('php://input');
    }


    /**
     * @return bool
     */
    protected function isIpAllowed()
    {
        return $this->skipIpCheck || in_array($_SERVER['REMOTE_ADDR'], $this->allowedIps);
    }

    public function setSkipIpCheck($skip = true)
    {
        $this->skipIpCheck = $skip;
    }

    public function isIpCheckSkipped() {
        return $this->skipIpCheck;
    }

}
