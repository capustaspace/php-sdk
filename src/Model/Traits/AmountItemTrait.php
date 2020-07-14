<?php

namespace Capusta\SDK\Model\Traits;


trait AmountItemTrait
{
    /**
     * @var string
     */
    private $currency;

    /**
     * @var integer|null
     */
    private $amount;

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount ? $this->amount:null;
    }

    /**
     * @param integer $amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

}
