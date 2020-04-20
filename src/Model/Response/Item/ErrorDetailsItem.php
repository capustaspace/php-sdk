<?php


namespace Capusta\SDK\Model\Response\Item;


use Capusta\SDK\Model\Response\AbstractResponse;
use Capusta\SDK\Model\Traits\RecursiveRestoreTrait;

class ErrorDetailsItem extends AbstractResponse
{
    use RecursiveRestoreTrait;

    const GENERAL_DECLINE = 'general_decline';
    const SECURITY_DECLINE = 'security_decline';
    const EXTERNAL_DECLINE = 'external_decline';
    const INVALID_ACCOUNT = 'invalid_account';
    const UNSUPPORTED_ACCOUNT = 'unsupported_account';
    const EXPIRED_CARD = 'expired_card';
    const TRANSACTION_LIMIT_EXCEEDED = 'transaction_limit_exceeded';
    const ACCOUNT_LIMIT_EXCEEDED = 'account_limit_exceeded';
    const INSUFFICIENT_FUNDS = 'insufficient_funds';
    const EXPIRED_TRANSACTION = 'expired_transaction';
    const COUNTRY_UNSUPPORTED = 'country_unsupported';

    /**
     * @var string
     */
    private $error;
    /**
     * @var string
     */
    private $description;

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param string $error
     *
     * @return $this
     */
    public function setError($error)
    {
        $this->error = $error;

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
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getRequiredFields()
    {
        return [
            'error' => self::TYPE_STRING,
            'description' => self::TYPE_STRING,
        ];
    }

    public function getOptionalFields()
    {
        return [];
    }
}
