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
        $description = $paymentRequest->getDescription();
        $custom = $paymentRequest->getCustom();
        $expire = $paymentRequest->getExpire();
        $contentUrl = $paymentRequest->getContentUrl();
        $projectCode = $paymentRequest->getProjectcode();
        $serializedCreatePayment = [];


        if ($id) {
            $serializedCreatePayment['id'] = $id;
        }

        $serializedCreatePayment['amount'] = [
            'currency' => $amount->getCurrency(),
            'amount' => $amount->getAmount(),
        ];
        if ($description) {
            $serializedCreatePayment['description'] = $description;
        }

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
            ];
        }

        if($custom) {
            $serializedCreatePayment['custom'] = (object)$custom;
        }

        if($expire) {
            $serializedCreatePayment['expire'] =  $expire->format(DateTime::ATOM);
        }

        return $serializedCreatePayment;
    }
}
