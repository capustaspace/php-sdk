<?php


namespace Capusta\SDK\Model\Response\Item;


use Capusta\SDK\Model\Response\AbstractResponse;
use Capusta\SDK\Model\Response\Payment\GetPaymentResponseTrait;
use Capusta\SDK\Model\Traits\RecursiveRestoreTrait;

class PaymentItem extends AbstractResponse
{
    use RecursiveRestoreTrait;
    use GetPaymentResponseTrait;
}
