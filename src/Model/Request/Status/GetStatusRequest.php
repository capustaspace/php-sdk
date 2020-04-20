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
        ];
    }
}
