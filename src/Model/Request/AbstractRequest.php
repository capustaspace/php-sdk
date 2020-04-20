<?php

namespace Capusta\SDK\Model\Request;


use Capusta\SDK\Model\Interfaces\RestorableInterface;

abstract class AbstractRequest implements RestorableInterface
{
    /**
     * @inheritDoc
     */
    public function getThoughOneField()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return var_export($this, true);
    }
}
