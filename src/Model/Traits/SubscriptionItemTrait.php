<?php

namespace Capusta\SDK\Model\Traits;

trait SubscriptionItemTrait
{
    /**
     * @var string|null
     */
    private $per;

    /**
     * @var integer
     */
    private $oneTimePayment;

    /**
     * @return string
     */
    public function getPer()
    {
        return $this->per ? $this->per : null;
    }

    /**
     * @return string
     */
    public function getOneTimePayment()
    {
        return $this->oneTimePayment;
    }

}
