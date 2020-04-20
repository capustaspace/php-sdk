<?php

namespace Capusta\SDK\Model\Response\Payout;


use Capusta\SDK\Model\Interfaces\RestorableInterface;
use Capusta\SDK\Model\Response\AbstractResponse;
use Capusta\SDK\Model\Response\Item\AmountResponseItem;
use Capusta\SDK\Model\Traits\RecursiveRestoreTrait;

class CreatePayoutResponse extends AbstractResponse
{
    use RecursiveRestoreTrait;

    /**
     * @var string
     */
    private $id;

    /**
     * @var AmountResponseItem
     */
    private $amount;

    /**
     * @var integer|null
     */
    private $projectId;


    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return AmountResponseItem
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return integer
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @inheritDoc
     */
    public function getOptionalFields()
    {
        return [
            'projectCode' => RestorableInterface::TYPE_STRING,
        ];
    }

    /**
     * @inheritDoc
     */
    public function getRequiredFields()
    {
        return [
            'id' => RestorableInterface::TYPE_STRING,
            'projectId' => AbstractResponse::TYPE_INTEGER,
            'amount' => AmountResponseItem::class,

        ];
    }
}
