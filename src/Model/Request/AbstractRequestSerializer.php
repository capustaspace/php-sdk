<?php


namespace Capusta\SDK\Model\Request;


abstract class AbstractRequestSerializer
{
    /** @var AbstractRequest */
    protected $request;

    /**
     * AbstractRequestSerializer constructor.
     *
     * @param AbstractRequest $request
     */
    public function __construct(AbstractRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @return array
     */
    abstract public function getSerializedData();
}
