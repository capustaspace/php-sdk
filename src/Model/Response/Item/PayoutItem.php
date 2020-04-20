<?php


namespace Capusta\SDK\Model\Response\Item;


use Capusta\SDK\Model\Response\AbstractResponse;
use Capusta\SDK\Model\Response\Payout\GetPayoutResponseTrait;
use Capusta\SDK\Model\Traits\RecursiveRestoreTrait;

class PayoutItem extends AbstractResponse
{
    use RecursiveRestoreTrait;
    use GetPayoutResponseTrait;
}
