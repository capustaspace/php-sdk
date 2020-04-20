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
     * @var NotificationRequest|null
     */
    private $request;

    /**
     * @param string $merchantEmail
     */
    private function setMerchantEmail($merchantEmail)
    {
        $this->merchantEmail = $merchantEmail;
    }

    /**
     * @param NotificationRequest $request
     */
    private function setRequest(NotificationRequest $request)
    {
        $this->request = $request;
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
        $this->request = $request;
        return $this->request;
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
        $auth  = $_SERVER["HTTP_AUTHORIZATION"];;
        if (!isset($auth) || $auth == '') {
            throw new NotificationSecurityException('No Authorization Bearer received');
        }
        $correctAuth = 'Bearer '.$this->merchantEmail.':'.$this->token;
        if ($auth !== $correctAuth) {
            throw new NotificationSecurityException('Incorrect Authorization Bearer received ');
        }

        if (strtolower($_SERVER['REQUEST_METHOD']) !== 'post') {
            throw new NotificationSecurityException('Only post requests are expected');
        }

        if (!$this->isIpAllowed()) {
            throw new NotificationSecurityException('Remote ip is not allowed');
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
