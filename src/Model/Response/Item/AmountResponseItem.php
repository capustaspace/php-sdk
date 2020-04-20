<?php


namespace Capusta\SDK\Model\Response\Item;


use Capusta\SDK\Model\Interfaces\RestorableInterface;
use Capusta\SDK\Model\Response\AbstractResponse;
use Capusta\SDK\Model\Traits\AmountResponseItemTrait;
use Capusta\SDK\Model\Traits\RecursiveRestoreTrait;

class AmountResponseItem extends AbstractResponse
{
    use AmountResponseItemTrait;
    use RecursiveRestoreTrait;

    /**
     * @inheritDoc
     */
    public function getOptionalFields()
    {
        return [

        ];
    }

    public function getRequiredFields()
    {
        return [
            'currency' => RestorableInterface::TYPE_STRING,
            'amount' => RestorableInterface::TYPE_INTEGER,
            'commission' => RestorableInterface::TYPE_INTEGER,
        ];
    }
}
