<?php


namespace Capusta\SDK\Model\Request\Status;


use Capusta\SDK\Model\Request\AbstractRequestTransport;
use Capusta\SDK\Transport\AbstractApiTransport;

class GetStatusTransport extends AbstractRequestTransport
{
    const PATH = '/partner/status';
    protected $version = 'v1';
    /**
     * @inheritDoc
     */
    public function getPath()
    {
       return $this->version.self::PATH;
    }

    /**
     * @inheritDoc
     */
    public function getMethod()
    {
        return AbstractApiTransport::METHOD_GET;
    }


}
