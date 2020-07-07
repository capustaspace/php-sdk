<?php


namespace Capusta\SDK\Model\Request\Bill;


use Capusta\SDK\Model\Request\AbstractRequestSerializer;
use DateTime;

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
        $custom = $billRequest->getCustom();
        $expire = $billRequest->getExpire();
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

        if ($custom) {
            $serializedCreateBill['custom'] = (object)$custom;
        }
        if ($expire) {
            $serializedCreateBill['expire'] =  $expire->format(DateTime::ATOM);
        }

        if ($contentUrl) {
            $serializedCreateBill['contentUrl'] = $contentUrl;
        }
        return $serializedCreateBill;
    }
}
