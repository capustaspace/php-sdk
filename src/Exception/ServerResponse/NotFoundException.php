<?php


namespace Capusta\SDK\Exception\ServerResponse;


class NotFoundException extends AbstractResponseException
{
    const HTTP_CODE = 404;

    /**
     * @inheritDoc
     */
    public function getHttpCode()
    {
        return self::HTTP_CODE;
    }
}
