<?php

namespace Capusta\SDK\Model\Traits;


trait BillTariffTrait
{
    /**
     * @var AmountItemTrait
     */
    private $amount;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string|null
     */
    private $contenturl;


    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param AmountItemTrait $amount
     *
     * @return $this
     */
    public function setAmount(AmountItemTrait $amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContenturl()
    {
        return $this->contenturl;
    }

    /**
     * @param string $contenturl
     *
     * @return $this
     */
    public function setContenturl(string $contenturl)
    {
        $this->contenturl = $contenturl;

        return $this;
    }
}
