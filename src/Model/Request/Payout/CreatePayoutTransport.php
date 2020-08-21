<?php


namespace Capusta\SDK\Model\Request\Payout;


use Capusta\SDK\Model\Request\AbstractRequestTransport;
use Capusta\SDK\Transport\AbstractApiTransport;

class CreatePayoutTransport extends AbstractRequestTransport
{
    const PATH = 'v1/partner/payout';

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
