<?php

namespace Capusta\SDK\Model\Response\Project;


use Capusta\SDK\Model\Interfaces\RestorableInterface;
use Capusta\SDK\Model\Response\AbstractResponse;
use Capusta\SDK\Model\Traits\RecursiveRestoreTrait;

class CreateProjectResponse extends AbstractResponse
{
    use RecursiveRestoreTrait;

    /**
     * @var integer
     */
    private $merchantId;

    /**
     * @var integer
     */
    private $projectId;

    /**
     * @var string
     */
    private $projectCode;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $status;

    /**
     * @return integer
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @return integer
     */
    public function getProjectId()
    {
        return $this->projectId;
    }


    /**
     * @return  string
     */
    public function getProjectCode()
    {
        return $this->projectCode;
    }

    /**
     * @return  string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return  string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @inheritDoc
     */
    public function getOptionalFields()
    {
        return [

        ];
    }

    /**
     * @inheritDoc
     */
    public function getRequiredFields()
    {
        return [
            'merchantId' => RestorableInterface::TYPE_INTEGER,
            'projectId' => RestorableInterface::TYPE_INTEGER,
            'projectCode' => RestorableInterface::TYPE_STRING,
            'token' => RestorableInterface::TYPE_STRING,
            'status' => RestorableInterface::TYPE_STRING,
        ];
    }
}
