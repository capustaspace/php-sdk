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
     * @var string
     */
    private $successUrl;

    /**
     * @var string
     */
    private $failUrl;

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
            'contentUrl' => self::TYPE_STRING,
            'custom'    => self::TYPE_ARRAY,
            'expire' => self::TYPE_DATE,
            'test' => self::TYPE_BOOLEAN,
            'successUrl' => self::TYPE_STRING,
            'failUrl' => self::TYPE_STRING
        ];
    }
}
