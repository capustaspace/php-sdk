<?php

namespace Capusta\SDK\Model\Response\Registry;


use Capusta\SDK\Model\Response\AbstractResponse;
use Capusta\SDK\Model\Traits\RecursiveRestoreTrait;

class GetRegistryResponse extends AbstractResponse
{
    use RecursiveRestoreTrait;
    /**
     * @inheritDoc
     */
    public function getOptionalFields()
    {
        return [

        ];
    }

    /**
     * @inheritDoc
     */
    public function getRequiredFields()
    {
        return [

        ];
    }
}
