<?php


namespace Capusta\SDK\Transport\Authorization;


class TokenAuthorization extends AbstractAuthorization
{
    const AUTH_TYPE = 'Bearer';

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $token;

    /**
     * TokenAuthorization constructor.
     *
     * @param string $username
     * @param string $token
     */
    public function __construct($username, $token)
    {
        $this->username = $username;
        $this->token = $token;
    }

    /**
     * @inheritDoc
     */
    protected function getType()
    {
        return self::AUTH_TYPE;
    }

    /**
     * @inheritDoc
     */
    protected function getAuth()
    {
        return $this->username . ':' . $this->token;
    }
}
