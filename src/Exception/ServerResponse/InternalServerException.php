<?php


namespace Capusta\SDK\Exception\ServerResponse;


class InternalServerException extends AbstractResponseException
{
    const HTTP_CODE = 500;

    /**
     * @inheritDoc
     */
    public function getHttpCode()
    {
        return self::HTTP_CODE;
    }
}
