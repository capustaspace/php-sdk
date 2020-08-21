<?php


namespace Capusta\SDK\Model\Request\Bill;


use Capusta\SDK\Model\Request\AbstractRequestTransport;
use Capusta\SDK\Transport\AbstractApiTransport;

class CreateBillTransport extends AbstractRequestTransport
{
    const PATH = 'v1/partner/bill';

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
