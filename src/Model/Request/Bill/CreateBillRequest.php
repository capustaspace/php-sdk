<?php

namespace Capusta\SDK\Model\Request\Bill;


use Capusta\SDK\Model\Request\AbstractRequest;
use Capusta\SDK\Model\Request\Item\AmountRequestItem;
use Capusta\SDK\Model\Request\Item\SenderRequestItem;
use Capusta\SDK\Model\Traits\RecursiveRestoreTrait;

class CreateBillRequest extends AbstractRequest
{
    use RecursiveRestoreTrait;

    /**
     * @var string|null
     */
    private $id;

    /**
     * @var AmountRequestItem
     */
    private $amount;

    /**
     * @var SenderRequestItem
     */
    private $sender;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var string|null
     */
    private $contentUrl;

    /**
     * @var string
     */
    private $projectCode;

    /**
     * @var string
     */
    private $successUrl;

    /**
     * @var string
     */
    private $failUrl;

    /**
     * @var array|null
     */
    private $custom;

    /**
     * @var \DateTime
     */
    private $expire;

    /**
     * @var bool
     */
    private $test;

    /**
     * @return string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContentUrl()
    {
        return $this->contentUrl;
    }

    /**
     * @param string|null $contentUrl
     *
     * @return $this
     */
    public function setContentUrl($contentUrl)
    {
        $this->contentUrl = $contentUrl;

        return $this;
    }

    /**
     * @return AmountRequestItem
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param AmountRequestItem $amount
     *
     * @return self
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return SenderRequestItem|null
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
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }


    /**
     * @return string
     */
    public function getProjectCode()
    {
        return $this->projectCode;
    }

    /**
     * @param string $projectcode
     *
     * @return $this
     */
    public function setProjectCode($projectcode)
    {
        $this->projectCode = $projectcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getSuccessUrl()
    {
        return $this->successUrl;
    }

    /**
     * @param string $successUrl
     *
     * @return $this
     */
    public function setSuccessUrl($successurl)
    {
        $this->successUrl = $successurl;
        return $this;
    }

    /**
     * @return string
     */
    public function getFailUrl()
    {
        return $this->failUrl;
    }

    /**
     * @param string $failurl
     *
     * @return $this
     */
    public function setFailUrl($failurl)
    {
        $this->failUrl = $failurl;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getCustom()
    {
        return $this->custom;
    }

    /**
     * @param array $custom
     *
     * @return $this
     */
    public function setCustom($custom)
    {
        $this->custom = $custom;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpire()
    {
        return $this->expire;
    }

    /**
     * @param \DateTime $expire
     */
    public function setExpire($expire)
    {
        $this->expire = $expire;
    }

    /**
     * @return bool
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * @param bool $test
     */
    public function setTest($test)
    {
        $this->test = $test;
    }

    /**
     * @inheritDoc
     */
    public function getRequiredFields()
    {
        return [
            'amount' => AmountRequestItem::class,
            'projectCode' => self::TYPE_STRING,
        ];
    }

    /**
     * @inheritDoc
     */
    public function getOptionalFields()
    {
        return [
            'id' => self::TYPE_STRING,
            'description' => self::TYPE_STRING,
            'custom' => self::TYPE_ARRAY,
            'sender' => SenderRequestItem::class,
            'contentUrl' => self::TYPE_STRING,
            'expire' => self::TYPE_DATE,
            'test' => self::TYPE_BOOLEAN,
            'successUrl' => self::TYPE_STRING,
            'failUrl' => self::TYPE_STRING
        ];
    }
}
