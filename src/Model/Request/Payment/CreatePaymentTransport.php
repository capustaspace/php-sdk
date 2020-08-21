<?php


namespace Capusta\SDK\Model\Request\Payment;


use Capusta\SDK\Model\Request\AbstractRequestTransport;
use Capusta\SDK\Transport\AbstractApiTransport;

class CreatePaymentTransport extends AbstractRequestTransport
{
    const PATH = 'v1/partner/payment';

    /**
     * @inheritDoc
     */
    public function getPath()
    {
        return self::PATH;
    }

    /**
     * @inheritDoc
     */
    public function getMethod()
    {
        return AbstractApiTransport::METHOD_POST;
    }
}