<?php


namespace Capusta\SDK\Model\Request\Item;


use Capusta\SDK\Model\Traits\SubscriptionItemTrait;
use Capusta\SDK\Model\Traits\RecursiveRestoreTrait;

class SubscriptionRequestItem extends AbstractRequestItem
{
    use SubscriptionItemTrait;
    use RecursiveRestoreTrait;

    /**
     * @inheritDoc
     */
    public function getRequiredFields()
    {
        return [
        ];
    }

    /**
     * @inheritDoc
     */
    public function getOptionalFields()
    {
        return [
            'per' => self::TYPE_STRING,
            'oneTimePayment' => self::TYPE_BOOLEAN,
        ];
    }
}
