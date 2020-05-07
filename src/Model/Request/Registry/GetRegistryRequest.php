<?php

namespace Capusta\SDK\Model\Request\Registry;


use Capusta\SDK\Model\Request\AbstractRequest;
use Capusta\SDK\Model\Traits\RecursiveRestoreTrait;

class GetRegistryRequest extends AbstractRequest
{
    use RecursiveRestoreTrait;

    /**
     * @var string
     */
    private $projectCode;

    /**
    * @var \DateTime
     */
    private $from;

    /**
     * @var \DateTime
     */
    private $to;



    /**
     * @return string
     */
    public function getProjectCode()
    {
        return $this->projectCode;
    }

    /**
     * @param string $projectCode
     *
     * @return $this
     */
    public function setProjectCode($projectCode)
    {
        $this->projectCode = $projectCode;

        return $this;
    }

    /**
     * @return |DateTime
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param $from |DateTime
     * @return $this
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @return |DateTime
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param $to |DateTime
     * @return $this
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRequiredFields()
    {
        return [
            'projectCode' => self::TYPE_STRING,
            'from' => AbstractRequest::TYPE_DATE,
            'to' => AbstractRequest::TYPE_DATE,
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
