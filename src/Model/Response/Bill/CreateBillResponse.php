<?php

namespace Capusta\SDK\Model\Response\Bill;


use Capusta\SDK\Model\Interfaces\RestorableInterface;
use Capusta\SDK\Model\Request\Item\SenderRequestItem;
use Capusta\SDK\Model\Request\Item\SubscriptionRequestItem;
use Capusta\SDK\Model\Response\AbstractResponse;
use Capusta\SDK\Model\Response\Item\AmountResponseItem;
use Capusta\SDK\Model\Response\Item\SubscriptionResponseItem;
use Capusta\SDK\Model\Traits\RecursiveRestoreTrait;
use Capusta\SDK\Model\Traits\SubscriptionItemTrait;

class CreateBillResponse extends AbstractResponse
{
    use RecursiveRestoreTrait;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $status;

    /**
     * @var AmountResponseItem
     */
    private $amount;

    /**
     * @var SubscriptionResponseItem
     */
    private $subscription;


    /**
     * @var string|null
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $expire;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var string|null
     */
    private $projectCode;

    /**
     * @var string|null
     */
    private $successUrl;

    /**
     * @var string|null
     */
    private $failUrl;

    /**
     * @var integer|null
     */
    private $projectId;


    /**
     * @var string
     */
    private $payUrl;

    /**
     * @var string|null
     */
    private $contentUrl;

    /**
     * @var SenderRequestItem|null
     */
    private $sender;

    /**
     * @var array|null
     */
    private $custom;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return SenderRequestItem|null
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @return array|null
     */
    public function getCustom()
    {
        return $this->custom;
    }

    /**
     * @return AmountResponseItem
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return SubscriptionResponseItem
     */
    public function getSubscription()
    {
        return $this->subscription;
    }

    /**
     * @return  string|null
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * @return integer|null
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @return string
     */
    public function getProjectCode()
    {
        return $this->projectCode;
    }

    /**
     * @return string
     */
    public function getSuccessUrl()
    {
        return $this->successUrl;
    }

    /**
     * @return string
     */
    public function getFailUrl()
    {
        return $this->failUrl;
    }

    /**
     * @return |DateTime
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * @return |DateTime
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }


    /**
     * @return string
     */
    public function getPayUrl()
    {
        return $this->payUrl;
    }

    /**
     * @return string
     */
    public function getContentUrl()
    {
        return $this->contentUrl;
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
            'custom' => AbstractResponse::TYPE_ARRAY,
            'subscription' => SubscriptionRequestItem::class,
            'contentUrl' => RestorableInterface::TYPE_STRING,
            'updated_at' => RestorableInterface::TYPE_DATE,
            'expire' => RestorableInterface::TYPE_DATE,
            'successUrl' => RestorableInterface::TYPE_STRING,
            'failUrl' => RestorableInterface::TYPE_STRING,
        ];
    }

    /**
     * @inheritDoc
     */
    public function getRequiredFields()
    {
        return [
            'id' => RestorableInterface::TYPE_STRING,
            'status' => RestorableInterface::TYPE_STRING,
            'payUrl' => RestorableInterface::TYPE_STRING,
            'created_at' => RestorableInterface::TYPE_DATE,
            'amount' => AmountResponseItem::class,
            'projectCode' => RestorableInterface::TYPE_STRING,
        ];
    }
}
