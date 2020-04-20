<?php


namespace Capusta\SDK\Actions;


use Capusta\SDK\Model\Types\AbstractCustomType;
use Capusta\SDK\Exception\Validation\BadGetterException;
use Capusta\SDK\Exception\Validation\EmptyRequiredPropertyException;
use Capusta\SDK\Exception\Validation\InvalidPropertyException;
use Capusta\SDK\Exception\Validation\InvalidPropertyTypeException;
use Capusta\SDK\Model\Interfaces\DataContainerInterface;
use Capusta\SDK\Model\Interfaces\RestorableInterface;
use Capusta\SDK\Utils\AccessorUtil;

class ObjectRecursiveValidator
{
    /**
     * @param DataContainerInterface $object
     *
     * @throws BadGetterException
     * @throws EmptyRequiredPropertyException
     * @throws InvalidPropertyException
     * @throws InvalidPropertyTypeException
     */
    public static function validate(DataContainerInterface $object)
    {
        $existedFields = [];

        foreach ($object->getRequiredFields() as $field => $type) {
            $value = self::getFieldValue($object, $field);

            if (empty($value)) {
                throw new EmptyRequiredPropertyException(sprintf('Required property (%s) is empty', $field), 0, $field);
            }

            self::validateValue($value, $field, $type);
            $existedFields[] = $field;
        }

        foreach ($object->getOptionalFields() as $field => $type) {
            $value = self::getFieldValue($object, $field);

            if (empty($value)) {
                continue;
            }

            self::validateValue($value, $field, $type);
            $existedFields[] = $field;
        }

        foreach ($object->getThoughOneField() as $thoughFields) {
            $missedFields = array_diff($thoughFields, $existedFields);

            if (count($missedFields) === count($thoughFields)) {
                throw new EmptyRequiredPropertyException(sprintf('There must be at least one field: %s', join(' or ', $thoughFields)));
            }
        }

    }

    /**
     * @param mixed        $value
     * @param string       $field
     * @param string|array $type
     *
     * @throws InvalidPropertyException
     * @throws InvalidPropertyTypeException
     * @throws BadGetterException
     */
    protected static function validateValue($value, $field, $type)
    {
        switch ($type) {
            case RestorableInterface::TYPE_INTEGER:
                if (!is_int($value)) {
                    throw new InvalidPropertyException('Property value is not integer', 0, $field);
                }
                break;
            case RestorableInterface::TYPE_BOOLEAN:
                if (!is_bool($value)) {
                    throw new InvalidPropertyException('Property value is not boolean', 0, $field);
                }
                break;
            case RestorableInterface::TYPE_FLOAT:
                if (!is_float($value)) {
                    throw new InvalidPropertyException('Property value is not float', 0, $field);
                }
                break;
            case RestorableInterface::TYPE_STRING:
                if (!is_string($value)) {
                    throw new InvalidPropertyException('Property value is not string', 0, $field);
                }
                break;
            case RestorableInterface::TYPE_ARRAY:
                if (!is_array($value)) {
                    throw new InvalidPropertyException('Property value is not array', 0, $field);
                }
                break;
            case RestorableInterface::TYPE_DATE:
                if (!($value instanceof \DateTimeInterface)) {
                    throw new InvalidPropertyException('Property value is not date', 0, $field);
                }
                break;
            case $type instanceof AbstractCustomType:
                $type->validate($field);
                break;
            case is_array($type):
                if (empty($type) || count($type) > 1) {
                    throw new InvalidPropertyException('Incorrect array type. Please provide one element in array.');
                }

                $type = reset($type);

                foreach ((array)$value as $data) {
                    self::validateValue($data, $field, $type);
                }
                break;
            default:
                if ($value instanceof DataContainerInterface && is_subclass_of($type, DataContainerInterface::class)) {
                    self::validate($value);
                    break;
                }

                throw new InvalidPropertyTypeException('There is no provided type of property', 0, $field);
        }
    }

    /**
     * @param DataContainerInterface $object
     * @param                        $field
     *
     * @return mixed
     * @throws BadGetterException
     */
    protected static function getFieldValue(DataContainerInterface $object, $field)
    {
        $getter = $method = AccessorUtil::getter($field);
        if (!method_exists($object, $getter)) {
            $isser = $method = AccessorUtil::isser($field);

            if (!method_exists($object, $isser)) {
                throw new BadGetterException(sprintf('Getter %s or %s for object does not exists', $getter, $isser));
            }
        }

        return $object->{$method}();
    }
}
