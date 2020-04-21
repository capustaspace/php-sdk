<?php

namespace Capusta\SDK\Model\Request\Project;


use Capusta\SDK\Model\Request\AbstractRequest;
use Capusta\SDK\Model\Request\Item\AmountRequestItem;
use Capusta\SDK\Model\Traits\RecursiveRestoreTrait;

class CreateProjectRequest extends AbstractRequest
{
    use RecursiveRestoreTrait;

    /**
     * @var string
     */
    private $email;


    /**
     * @var string
     */
    private $projectLink;

    /**
     * @var string
     */
    private $callbackUrl;

    /**
     * @var string
     */
    private $failUrl;

    /**
     * @var string
     */
    private $successUrl;

    /**
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getProjectLink()
    {
        return $this->projectLink;
    }

    /**
     * @param string $projectLink
     *
     * @return $this
     */
    public function setProjectLink($projectLink)
    {
        $this->projectLink = $projectLink;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallbackUrl()
    {
        return $this->callbackUrl;
    }

    /**
     * @param string $callbackUrl
     *
     * @return $this
     */
    public function setCallbackUrl($callbackUrl)
    {
        $this->callbackUrl = $callbackUrl;
        return $this;
    }


    /**
     * @return string
     */
    public function getFailUrl()
    {
        return $this->failUrl;
    }

    /**
     * @param string $failUrl
     *
     * @return $this
     */
    public function setFailUrl($failUrl)
    {
        $this->failUrl = $failUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getSuccessUrl()
    {
        return $this->successUrl;
    }

    /**
     * @param string $successUrl
     *
     * @return $this
     */
    public function setSuccessUrl($successUrl)
    {
        $this->successUrl = $successUrl;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRequiredFields()
    {
        return [
            'email' => self::TYPE_STRING,
            'projectLink' => self::TYPE_STRING,
            'callbackUrl' => self::TYPE_STRING,
            'failUrl' => self::TYPE_STRING,
            'successUrl' => self::TYPE_STRING,
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
