<?php


namespace Capusta\SDK\Model\Response\Item;


use Capusta\SDK\Model\Response\AbstractResponse;
use Capusta\SDK\Model\Response\Bill\GetBillResponseTrait;
use Capusta\SDK\Model\Traits\RecursiveRestoreTrait;

class BillItem extends AbstractResponse
{
    use RecursiveRestoreTrait;
    use GetBillResponseTrait;
}
