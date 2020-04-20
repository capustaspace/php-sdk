<?php


namespace Capusta\SDK\Model\Request;


use Capusta\SDK\Transport\AbstractApiTransport;

abstract class AbstractRequestTransport
{
    /** @var AbstractRequestSerializer */
    protected $serializer;

    /**
     * AbstractRequestTransport constructor.
     *
     * @param AbstractRequestSerializer $serializer
     */
    public function __construct(AbstractRequestSerializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @return string
     */
    abstract public function getPath();

    /**
     * @return string
     */
    public function getMethod()
    {
        return AbstractApiTransport::METHOD_POST;
    }

    /**
     * @return array
     */
    public function getQueryParams()
    {
        return $this->getMethod() == AbstractApiTransport::METHOD_GET ? $this->serializer->getSerializedData() : [];
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return $this->getMethod() == AbstractApiTransport::METHOD_POST ? $this->serializer->getSerializedData() : [];
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return [];
    }
}
