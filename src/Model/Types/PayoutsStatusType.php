<?php


namespace Capusta\SDK\Model\Types;


use Capusta\SDK\Exception\Validation\InvalidPropertyException;
use Capusta\SDK\Model\PayoutStatuses;
use Capusta\SDK\Model\Request\AbstractRequest;

class PayoutsStatusType extends AbstractCustomType
{
    /**
     * @inheritDoc
     */
    public function validate($field)
    {
        $paymentStatus = $this->getValue($field);

        if (!in_array($paymentStatus, PayoutStatuses::getStatuses(), true)) {
            throw new InvalidPropertyException('Unsupportable payout status', 0, $field);
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function isAccept()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getBaseType()
    {
        return AbstractRequest::TYPE_STRING;
    }
}
