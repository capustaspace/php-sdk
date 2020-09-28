<?php

namespace Capusta\SDK\Model\Response\Status;


use Capusta\SDK\Model\Interfaces\RestorableInterface;
use Capusta\SDK\Model\Request\Item\SenderRequestItem;
use Capusta\SDK\Model\Response\AbstractResponse;
use Capusta\SDK\Model\Response\Item\AmountItem;
use Capusta\SDK\Model\Response\Payment\CreatePaymentResponse;
use Capusta\SDK\Model\Types\AbstractCustomType;

class GetStatusResponse extends CreatePaymentResponse
{

    /**
     * @var array|null
     */
    public $transactions;

    /**
     * @var boolean
     */
    public $multiBill;

    /**
     * @var boolean
     */
    public $billPaymentEnabled;


    /**
     * @return array|null
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    public function getRequiredFields()
    {
        return [
            'id' => AbstractResponse::TYPE_STRING,
            'transactionId' => AbstractResponse::TYPE_STRING,
            'partnerPaymentId' => AbstractResponse::TYPE_STRING,
            'amount' => AmountItem::class,
            'status' => AbstractResponse::TYPE_STRING,
            'projectId' => AbstractResponse::TYPE_INTEGER,
            'projectCode' => AbstractResponse::TYPE_STRING,
            'payUrl' => AbstractResponse::TYPE_STRING,
            'sender' => SenderRequestItem::class,
            'multiBill' => AbstractResponse::TYPE_BOOLEAN,
            'billPaymentEnabled' => AbstractResponse::TYPE_BOOLEAN,
            'created_at' => RestorableInterface::TYPE_DATE
        ];
    }
    /**
     * @inheritDoc
     */
    public function getOptionalFields()
    {
        return [
            'sender' => SenderRequestItem::class,
            'expire' => RestorableInterface::TYPE_DATE,
            'custom' => AbstractResponse::TYPE_STRING,
            'description' => AbstractResponse::TYPE_STRING,
            'contentUrl' => RestorableInterface::TYPE_STRING,
            'updated_at' => RestorableInterface::TYPE_DATE,
            'transactions' => AbstractResponse::TYPE_ARRAY
        ];
    }
}
