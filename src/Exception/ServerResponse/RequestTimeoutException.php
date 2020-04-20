<?php


namespace Capusta\SDK\Exception\ServerResponse;


class RequestTimeoutException extends AbstractResponseException
{
    const HTTP_CODE = 408;

    /**
     * @inheritDoc
     */
    public function getHttpCode()
    {
        return self::HTTP_CODE;
    }
}
