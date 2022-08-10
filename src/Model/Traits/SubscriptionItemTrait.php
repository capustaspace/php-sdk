<?php

namespace Capusta\SDK\Model\Traits;

trait SubscriptionItemTrait
{
    /**
     * @var string|null
     */
    private $per;

    /**
     * @var integer|null
     */
    private $oneTimePayment;

    /**
     * @var integer
     */
    private $trialDays;

    /**
     * @return string|null
     */
    public function getPer()
    {
        return $this->per ? $this->per : null;
    }

    /**
     * @return string|null
     */
    public function getOneTimePayment()
    {
        return $this->oneTimePayment;
    }

    /**
     * @return integer
     */
    public function getTrialDays()
    {
        return $this->trialDays;
    }

}
