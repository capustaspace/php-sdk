<?php


namespace Capusta\SDK\Model\Request\Bill;


use Capusta\SDK\Model\Request\AbstractRequestSerializer;

class CreateBillSerializer extends AbstractRequestSerializer
{
    /**
     * @inheritDoc
     */
    public function getSerializedData()
    {
        /** @var CreateBillRequest $billRequest */
        $billRequest = $this->request;
        $id = $billRequest->getId();
        $amount = $billRequest->getAmount();
        $description = $billRequest->getDescription();
        $projectCode = $billRequest->getProjectcode();
        $contentUrl = $billRequest->getContentUrl();
        $serializedCreateBill = [];


        if ($id) {
            $serializedCreateBill['id'] = $id;
        }

        $serializedCreateBill['amount'] = [
            'currency' => $amount->getCurrency(),
            'amount' => $amount->getAmount(),
        ];

        if ($description) {
            $serializedCreateBill['description'] = $description;
        }

        $serializedCreateBill['projectCode'] = $projectCode;

        if ($contentUrl) {
            $serializedCreateBill['contentUrl'] = $contentUrl;
        }
        return $serializedCreateBill;
    }
}
