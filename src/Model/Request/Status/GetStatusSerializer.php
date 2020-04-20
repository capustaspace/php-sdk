<?php


namespace Capusta\SDK\Model\Request\Status;


use Capusta\SDK\Model\Request\AbstractRequestSerializer;

class GetStatusSerializer extends AbstractRequestSerializer
{
    /**
     * @inheritDoc
     */
    public function getSerializedData()
    {
        /** @var GetStatusRequest $statusRequest */
        $statusRequest = $this->request;
        $serializedCreateStatus['transaction-id'] = $statusRequest->getTransaction_id();
        return $serializedCreateStatus;
    }
}
