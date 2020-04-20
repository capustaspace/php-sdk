<?php

namespace Capusta\SDK\Model\Request\Item;


use Capusta\SDK\Model\Interfaces\RestorableInterface;

abstract class AbstractRequestItem implements RestorableInterface
{
    /**
     * @inheritDoc
     */
    public function getThoughOneField()
    {
        return [];
    }
}
