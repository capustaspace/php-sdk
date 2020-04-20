<?php


namespace Capusta\SDK\Exception\ServerResponse;


abstract class AbstractResponseException extends ResponseException
{
    const RESPONSE_CODE_UNKNOWN = 'unknown';

    /** @var string */
    protected $responseErrorCode;

    /** @var string */
    protected $responseErrorMessage;

    /**
     * @return int
     */
    abstract public function getHttpCode();

    public function __construct($headers = [], $body = null)
    {
        $this->parseBody($body);
        parent::__construct($this->getResponseMessage(), $this->getHttpCode(), $headers, $body);
    }

    /**
     * @return string
     */
    public function getResponseMessage()
    {
        $message = [];
        if ($this->responseErrorCode && $this->responseErrorCode !== self::RESPONSE_CODE_UNKNOWN) {
            $message[] = sprintf('Error: %s.', $this->responseErrorCode);
        }

        if ($this->responseErrorMessage) {
            $message[] = sprintf('Details: %s.', $this->responseErrorMessage);
        }

        return join(' ', $message);
    }

    /**
     * @param string $body
     */
    protected function parseBody($body)
    {
        $errors = (array)json_decode($body, true);

        if ($errors === null) {
            $errors['message'] = $body ?: null;
        }

        $this->responseErrorCode = !empty($errors['error']) ? $errors['error'] : self::RESPONSE_CODE_UNKNOWN;
        $this->responseErrorMessage = !empty($errors['message']) ? $errors['message'] : '';
    }

    /**
     * @return string
     */
    public function getResponseErrorCode()
    {
        return $this->responseErrorCode;
    }

    /**
     * @return string
     */
    public function getResponseErrorMessage()
    {
        return $this->responseErrorMessage;
    }
}
