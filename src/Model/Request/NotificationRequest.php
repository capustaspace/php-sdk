<?php


namespace Capusta\SDK\Model\Request;


use Capusta\SDK\Model\Response\Item\AmountResponseItem;
use Capusta\SDK\Model\Traits\RecursiveRestoreTrait;

class NotificationRequest extends AbstractRequest
{
    use RecursiveRestoreTrait;

    /**
     * @var string
     */
    private $transactionId;

    /**
     * @var string
     */
    private $signature;

    /**
     * @var AmountResponseItem
     */
    private $amount;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $ip;

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @param string $transactionId
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    /**
     * @return AmountResponseItem
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param AmountResponseItem $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }


    /**
     * @return null|string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param null|string $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


    public function getRequiredFields()
    {
        return [
            'transactionId' => AbstractRequest::TYPE_STRING,
            'amount' => AmountResponseItem::class,
            'status' => AbstractRequest::TYPE_STRING,
        ];
    }

    public function getOptionalFields()
    {
        return [

        ];
    }
}
