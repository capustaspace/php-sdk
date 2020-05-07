<?php


namespace Capusta\SDK\Model\Request\Registry;


use Capusta\SDK\Model\Request\AbstractRequestTransport;
use Capusta\SDK\Transport\AbstractApiTransport;

class GetRegistryTransport extends AbstractRequestTransport
{
    const PATH = 'partner/registry';

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
        return AbstractApiTransport::METHOD_GET;
    }
}
