<?php

namespace Capusta\SDK\Model\Request\Bill;


use Capusta\SDK\Model\Request\AbstractRequest;
use Capusta\SDK\Model\Request\Item\AmountRequestItem;
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
    private $custom;


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
    public function getProjectcode()
    {
        return $this->projectCode;
    }

    /**
     * @param string $projectcode
     *
     * @return $this
     */
    public function setProjectcode($projectcode)
    {
        $this->projectCode = $projectcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustom()
    {
        return $this->custom;
    }

    /**
     * @param string $custom
     *
     * @return $this
     */
    public function setCustom($custom)
    {
        $this->custom = $custom;
        return $this;
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
            'custom' => self::TYPE_STRING,
            'contentUrl' => self::TYPE_STRING
        ];
    }
}
