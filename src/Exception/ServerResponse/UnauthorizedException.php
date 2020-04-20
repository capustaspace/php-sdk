<?php


namespace Capusta\SDK\Exception\ServerResponse;


class UnauthorizedException extends AbstractResponseException
{
    const HTTP_CODE = 401;

    /**
     * @inheritDoc
     */
    public function getHttpCode()
    {
        return self::HTTP_CODE;
    }
}
