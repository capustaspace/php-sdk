<?php


namespace Capusta\SDK\Model\Response\Item;


use Capusta\SDK\Model\Response\AbstractResponse;
use Capusta\SDK\Model\Traits\RecursiveRestoreTrait;

class SubscriptionItem extends AbstractResponse
{
    use RecursiveRestoreTrait;

    /**
     * @var boolean
     */
    private $oneTimePayment;
    /**
     * @var string|null
     */
    private $per;

    /**
     * @return boolean
     */
    public function getPer()
    {
        return $this->per;
    }


    /**
     * @return string|null
     */
    public function getOneTimePayment()
    {
        return $this->oneTimePayment;
    }

    /**
     * @inheritDoc
     */
    public function getRequiredFields()
    {
        return [
            'oneTimePayment' => self::TYPE_STRING,
        ];
    }

    /**
     * @inheritDoc
     */
    public function getOptionalFields()
    {
        return [
            'per' => self::TYPE_BOOLEAN,
        ];
    }
}
