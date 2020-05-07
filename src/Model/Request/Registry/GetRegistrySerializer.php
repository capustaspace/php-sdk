<?php


namespace Capusta\SDK\Model\Request\Registry;


use Capusta\SDK\Model\Request\AbstractRequestSerializer;

class GetRegistrySerializer extends AbstractRequestSerializer
{
    /**
     * @inheritDoc
     */
    public function getSerializedData()
    {
        /** @var GetRegistryRequest $getRegistryRequest */
        $getRegistryRequest = $this->request;
        $data = [
            'from' => $getRegistryRequest->getFrom()->format('c'),
            'to' => $getRegistryRequest->getTo()->format('c'),
            'projectCode' => $getRegistryRequest->getProjectCode()
        ];

        return $data;
    }
}
