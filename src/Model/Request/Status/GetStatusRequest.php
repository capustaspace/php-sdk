<?php

namespace Capusta\SDK\Model\Request\Status;


use Capusta\SDK\Model\Request\AbstractRequest;
use Capusta\SDK\Model\Traits\RecursiveRestoreTrait;

class GetStatusRequest extends AbstractRequest
{
    use RecursiveRestoreTrait;

    /**
     * @var string
     */
    private $transaction_id;

    /**
     * @var boolean
     */
    private $withFailed;

    /**
     * @return string
     */
    public function getTransaction_id()
    {
        return $this->transaction_id;
    }

    /**
     * @param string $transaction_id
     *
     * @return $this
     */
    public function setTransaction_id($transaction_id)
    {
        $this->transaction_id = $transaction_id;

        return $this;
    }

    /**
     * @return bool
     */
    public function getWithFailed()
    {
        return $this->withFailed;
    }

    /**
     * @param $withFailed boolean
     * @return $this
     */
    public function setWithFaiiled($withFailed)
    {
        $this->withFailed = $withFailed;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRequiredFields()
    {
        return [
            'transaction_id' => self::TYPE_STRING,
        ];
    }

    /**
     * @inheritDoc
     */
    public function getOptionalFields()
    {
        return [
            'withFailed' => self::TYPE_BOOLEAN,
        ];
    }
}
