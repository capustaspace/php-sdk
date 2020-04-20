<?php


namespace Capusta\SDK\Exception\ServerResponse;


class BadRequestException extends AbstractResponseException
{
    const HTTP_CODE = 400;

    /**
     * @inheritDoc
     */
    public function getHttpCode()
    {
        return self::HTTP_CODE;
    }
}
