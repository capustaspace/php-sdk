<?php

namespace Capusta\SDK\Model\Request\Payout;


use Capusta\SDK\Model\Request\AbstractRequest;
use Capusta\SDK\Model\Request\Item\AmountRequestItem;
use Capusta\SDK\Model\Traits\RecursiveRestoreTrait;

class CreatePayoutRequest extends AbstractRequest
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
    private $projectCode;

    /**
     * @var integer|null
     */
    private $projectId;

    /**
     * @var integer
     */
    private $pan;

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
     * @return integer
     */
    public function getPan()
    {
        return $this->pan;
    }

    /**
     * @param integer $pan
     *
     * @return $this
     */
    public function setPan($pan)
    {
        $this->pan = $pan;

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
     * @return $this
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
     * @return string|null
     */
    public function getProjectCode()
    {
        return $this->projectCode;
    }

    /**
     * @param string $projectCode
     *
     * @return $this
     */
    public function setProjectCode($projectCode)
    {
        $this->projectCode = $projectCode;
        return $this;
    }

    /**
     * @return integer|null
    */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @param integer $projectId
     *
     * @return $this
     */
    public function setProjectId($projectId)
    {
        $this->projectCode = $projectId;
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
            'pan' => self::TYPE_INTEGER,
        ];
    }

    /**
     * @inheritDoc
     */
    public function getOptionalFields()
    {
        return [
            'id' => self::TYPE_STRING,
            'projectId' => self::TYPE_INTEGER,
            'description' => self::TYPE_STRING,
        ];
    }
}
