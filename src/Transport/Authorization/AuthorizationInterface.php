<?php


namespace Capusta\SDK\Transport\Authorization;


interface AuthorizationInterface
{
    /**
     * @return string
     */
    public function getAuthorizationHeader();
}
