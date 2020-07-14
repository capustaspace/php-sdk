<?php


namespace Capusta\SDK\Model\Request\Item;


use Capusta\SDK\Model\Traits\AmountItemTrait;
use Capusta\SDK\Model\Traits\RecursiveRestoreTrait;

class AmountRequestItem extends AbstractRequestItem
{
    use AmountItemTrait;
    use RecursiveRestoreTrait;

    /**
     * @inheritDoc
     */
    public function getRequiredFields()
    {
        return [
            'currency' => self::TYPE_STRING,
        ];
    }

    /**
     * @inheritDoc
     */
    public function getOptionalFields()
    {
        return [
            'amount' => self::TYPE_INTEGER,
        ];
    }
}
