<?php

namespace Capusta\SDK\Model\Response\Status;


use Capusta\SDK\Model\Interfaces\RestorableInterface;
use Capusta\SDK\Model\Request\Item\SenderRequestItem;
use Capusta\SDK\Model\Response\AbstractResponse;
use Capusta\SDK\Model\Response\Payment\CreatePaymentResponse;

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

    /**
     * @inheritDoc
     */
    public function getOptionalFields()
    {
        return [
            'description' => AbstractResponse::TYPE_STRING,
            'projectId' => AbstractResponse::TYPE_INTEGER,
            'sender' => SenderRequestItem::class,
            'contentUrl' => RestorableInterface::TYPE_STRING,
            'updated_at' => RestorableInterface::TYPE_DATE,
            'expire' => RestorableInterface::TYPE_DATE,
            'custom' => AbstractResponse::TYPE_STRING,
            'transactions' => AbstractResponse::TYPE_ARRAY,
            'multiBill' => AbstractResponse::TYPE_BOOLEAN,
            'billPaymentEnabled' => AbstractResponse::TYPE_BOOLEAN,
        ];
    }
}
