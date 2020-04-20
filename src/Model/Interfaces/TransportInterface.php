<?php


namespace Capusta\SDK\Model\Interfaces;


use Capusta\SDK\Model\Request\AbstractRequestSerializer;
use Capusta\SDK\Model\Request\AbstractRequestTransport;

interface TransportInterface
{
    /**
     * @param AbstractRequestSerializer $serializer
     *
     * @return AbstractRequestTransport
     */
    public function getTransport(AbstractRequestSerializer $serializer);
}
