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
        $sender = $billRequest->getSender();
        $description = $billRequest->getDescription();
        $projectCode = $billRequest->getProjectCode();
        $successUrl = $billRequest->getSuccessUrl();
        $failUrl = $billRequest->getFailUrl();
        $contentUrl = $billRequest->getContentUrl();
        $custom = $billRequest->getCustom();
        $expire = $billRequest->getExpire();
        $test = $billRequest->getTest();
        $serializedCreateBill = [];


        if ($id) {
            $serializedCreateBill['id'] = $id;
        }

        $serializedCreateBill['amount'] = [
            'currency' => $amount->getCurrency(),
        ];
        $amount = $amount->getAmount();
        if ($amount !== null) {
            $serializedCreateBill['amount']['amount'] = $amount;
        }

        if ($sender) {
            $serializedCreateBill['sender'] = [
                'name' => $sender->getName(),
                'email' => $sender->getEmail(),
                'comment' => $sender->getComment(),
                'phone' => $sender->getPhone(),
                'address' => $sender->getAddress(),
                'message' => $sender->getMessage(),
            ];
        }

        if ($description) {
            $serializedCreateBill['description'] = $description;
        }

        $serializedCreateBill['projectCode'] = $projectCode;
        if ($successUrl) {
            $serializedCreateBill['successUrl'] = $successUrl;
        }
        if ($failUrl) {
            $serializedCreateBill['failUrl'] = $failUrl;
        }
        if ($custom) {
            $serializedCreateBill['custom'] = (object)$custom;
        }
        if ($expire) {
            $serializedCreateBill['expire'] =  $expire->format(DateTime::ATOM);
        }

        if ($test) {
            $serializedCreateBill['test'] =  $test;
        }

        if ($contentUrl) {
            $serializedCreateBill['contentUrl'] = $contentUrl;
        }
        return $serializedCreateBill;
    }
}
