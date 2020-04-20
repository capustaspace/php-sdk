<?php

namespace Capusta\SDK\Model\Traits;


trait AmountResponseItemTrait
{
    /**
     * @var string
     */
    private $currency;

    /**
     * @var integer
     */
    private $amount;

    /**
     * @var integer
     */
    private $commission;

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
        return $this->amount;
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
    /**
     * @return integer
     */
    public function getCommission()
    {
        return $this->commission;
    }

    /**
     * @param integer $commission
     *
     * @return $this
     */
    public function setCommission($commission)
    {
        $this->commission = $commission;

        return $this;
    }
}
