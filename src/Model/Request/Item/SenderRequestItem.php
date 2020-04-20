<?php


namespace Capusta\SDK\Model\Request\Item;


use Capusta\SDK\Model\Traits\SenderItemTrait;
use Capusta\SDK\Model\Traits\RecursiveRestoreTrait;

class SenderRequestItem extends AbstractRequestItem
{
    use SenderItemTrait;
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
            'name' => self::TYPE_STRING,
            'phone' => self::TYPE_STRING,
            'email' => self::TYPE_STRING,
            'comment' => self::TYPE_STRING,
            'address' => self::TYPE_STRING,
        ];
    }
}
