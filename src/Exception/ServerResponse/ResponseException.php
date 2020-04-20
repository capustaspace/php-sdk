<?php


namespace Capusta\SDK\Exception\ServerResponse;


class ResponseException extends \Exception
{
    /**
     * @var array|string[]
     */
    protected $headers;

    /**
     * @var mixed|null
     */
    protected $body;

    /**
     * ResponseException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param array|string[] $headers
     * @param null|mixed     $body
     */
    public function __construct($message = '', $code = 0, $headers = [], $body = null)
    {
        parent::__construct($message, $code);
        $this->headers = $headers;
        $this->body = $body;
    }

    /**
     * @return array|string[]
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return mixed|null
     */
    public function getBody()
    {
        return $this->body;
    }
}
