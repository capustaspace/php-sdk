<?php


namespace Capusta\SDK\Model\Response\Item;


use Capusta\SDK\Model\Interfaces\RestorableInterface;
use Capusta\SDK\Model\Response\AbstractResponse;
use Capusta\SDK\Model\Traits\SubscriptionItemTrait;
use Capusta\SDK\Model\Traits\RecursiveRestoreTrait;

class SubscriptionResponseItem extends AbstractResponse
{
    use SubscriptionItemTrait;
    use RecursiveRestoreTrait;

    /**
     * @inheritDoc
     */
    public function getOptionalFields()
    {
        return [
            'oneTimePayment' => RestorableInterface::TYPE_STRING,
        ];
    }

    public function getRequiredFields()
    {
        return [
            'per' => RestorableInterface::TYPE_BOOLEAN,
        ];
    }
}
