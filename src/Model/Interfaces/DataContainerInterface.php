<?php


namespace Capusta\SDK\Model\Interfaces;


use Capusta\SDK\Exception\UnsupportableTypeException;

interface DataContainerInterface
{
    /**
     * @return array field_name => field_type
     * @throws UnsupportableTypeException
     */
    public function getRequiredFields();

    /**
     * @return array field_name => field_type
     * @throws UnsupportableTypeException
     */
    public function getOptionalFields();

    /**
     * @return array [[field_name, field_name, ...], [field_name, field_name, ...], ...]
     */
    public function getThoughOneField();
}
