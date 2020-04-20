<?php


namespace Capusta\SDK\Transport\Authorization;


abstract class AbstractAuthorization implements AuthorizationInterface
{

    /**
     * @return string
     */
    abstract protected function getAuth();

    /**
     * @inheritDoc
     */
    public function getAuthorizationHeader()
    {
        return sprintf('%s %s', $this->getType(), $this->getAuth());
    }
}
