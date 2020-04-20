<?php

namespace Capusta\SDK\Model\Request\Payment;


use Capusta\SDK\Model\Request\Bill\CreateBillRequest;
use Capusta\SDK\Model\Request\Item\SenderRequestItem;

class CreatePaymentRequest extends CreateBillRequest
{
    /**
     * @var SenderRequestItem
     */
    private $sender;

    /**
     * @return SenderRequestItem
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param SenderRequestItem $sender
     *
     * @return self
     */
    public function setSender($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getOptionalFields()
    {
        return [
            'id' => self::TYPE_STRING,
            'description' => self::TYPE_STRING,
            'sender' => SenderRequestItem::class,
            'contentUrl' => self::TYPE_STRING
        ];
    }
}
