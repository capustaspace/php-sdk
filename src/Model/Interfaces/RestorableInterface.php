<?php


namespace Capusta\SDK\Model\Interfaces;


interface RestorableInterface extends DataContainerInterface
{
    /** @var string Field type */
    const TYPE_BOOLEAN = 'boolean';

    /** @var string Field type */
    const TYPE_INTEGER = 'integer';

    /** @var string Field type */
    const TYPE_FLOAT = 'float';

    /** @var string Field type */
    const TYPE_STRING = 'string';

    /** @var string Field type */
    const TYPE_ARRAY = 'array';

    /** @var string Field type */
    const TYPE_DATE = 'date';

    /**
     * @param array $data
     * @param array $fields
     *
     * @return void
     * @throws \UnexpectedValueException
     */
    public function restore(array $data, array $fields);
}
