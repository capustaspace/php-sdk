<?php


namespace Capusta\SDK\Model\Request\Payment;


use Capusta\SDK\Model\Request\AbstractRequestSerializer;
use DateTime;

class CreatePaymentSerializer extends AbstractRequestSerializer
{
    /**
     * @inheritDoc
     */
    public function getSerializedData()
    {
        /** @var CreatePaymentRequest $paymentRequest */
        $paymentRequest = $this->request;
        $id = $paymentRequest->getId();
        $amount = $paymentRequest->getAmount();
        $sender = $paymentRequest->getSender();
        $successUrl = $paymentRequest->getSuccessUrl();
        $failUrl = $paymentRequest->getFailUrl();
        $description = $paymentRequest->getDescription();
        $custom = $paymentRequest->getCustom();
        $expire = $paymentRequest->getExpire();
        $test = $paymentRequest->getTest();
        $contentUrl = $paymentRequest->getContentUrl();
        $projectCode = $paymentRequest->getProjectCode();
        $serializedCreatePayment = [];


        if ($id) {
            $serializedCreatePayment['id'] = $id;
        }

        $serializedCreatePayment['amount'] = [
            'currency' => $amount->getCurrency(),
        ];
        $amount = $amount->getAmount();
        if ($amount !== null) {
            $serializedCreatePayment['amount']['amount'] = $amount;
        }

        if ($description) {
            $serializedCreatePayment['description'] = $description;
        }

        $serializedCreatePayment['successUrl'] = $successUrl;
        $serializedCreatePayment['failUrl'] = $failUrl;

        if ($contentUrl) {
            $serializedCreatePayment['contentUrl'] = $contentUrl;
        }

        $serializedCreatePayment['projectCode'] = $projectCode;

        if ($sender) {
            $serializedCreatePayment['sender'] = [
                'name' => $sender->getName(),
                'email' => $sender->getEmail(),
                'comment' => $sender->getComment(),
                'phone' => $sender->getPhone(),
                'address' => $sender->getAddress(),
                'message' => $sender->getMessage(),
            ];
        }

        if($custom) {
            $serializedCreatePayment['custom'] = (array)$custom;
        }

        if($expire) {
            $serializedCreatePayment['expire'] =  $expire->format(DateTime::ATOM);
        }

        if($test) {
            $serializedCreatePayment['test'] =  $test;
        }
        return $serializedCreatePayment;
    }
}
