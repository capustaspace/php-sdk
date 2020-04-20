<?php


namespace Capusta\SDK\Model\Traits;

use Capusta\SDK\Model\Types\AbstractCustomType;
use Capusta\SDK\Model\Interfaces\RestorableInterface;
use Capusta\SDK\Utils\AccessorUtil;

trait RecursiveRestoreTrait
{
    /**
     * @param array $data
     * @param array $fields
     *
     * @return void
     * @throws \UnexpectedValueException
     */
    public function restore(array $data, array $fields)
    {
        foreach ($fields as $field => $type) {
            if (!isset($data[$field])) {
                continue;
            }

            $property = AccessorUtil::property($field);
            $value = $data[$field];

            $value = $this->getPropertyValueForRestore($type, $value, $field);

            $this->{$property} = $value;
        }
    }

    /**
     * @param mixed  $type
     * @param mixed  $value
     * @param string $field
     *
     * @return mixed
     * @throws \UnexpectedValueException
     */
    private function getPropertyValueForRestore($type, $value, $field)
    {
        if ($type instanceof AbstractCustomType) {
            $type = $type->getBaseType();
        }

        switch ($type) {
            case RestorableInterface::TYPE_BOOLEAN:
                $value = (bool)$value;
                break;
            case RestorableInterface::TYPE_INTEGER:
                if (!is_numeric($value)) {
                    throw new \UnexpectedValueException('['.$field.']'. ' Value is not int');
                }

                $value = (int)$value;
                break;
            case RestorableInterface::TYPE_FLOAT:
                if (!is_numeric($value)) {
                    throw new \UnexpectedValueException('['.$field.']'.' Value is not float');
                }

                $value = (float)$value;
                break;
            case RestorableInterface::TYPE_STRING:
                if (!is_string($value) && !is_numeric($value)) {
                    throw new \UnexpectedValueException('['.$field.']'.' Value is not string');
                }

                $value = (string)$value;
                break;
            case RestorableInterface::TYPE_ARRAY:
                if (!is_array($value)) {
                    throw new \UnexpectedValueException('['.$field.']'.' Value is not array');
                }
                break;
            case RestorableInterface::TYPE_DATE:
                if (empty($value) || $value instanceof \DateTime) {
                    break;
                }

                try {
                    $value = new \DateTime($value);
                } catch (\Exception $e) {
                    throw new \UnexpectedValueException('Date incorrect ' . $field, 0, $e);
                }
                break;
            case is_array($type):
                if (empty($type) || count($type) > 1) {
                    throw new \UnexpectedValueException('Incorrect array type. Please provide one element in array.');
                }

                $type = reset($type);
                $arrayValues = [];

                foreach ((array)$value as $data) {
                    $arrayValues[] = $this->getPropertyValueForRestore($type, $data, $field);
                }

                $value = $arrayValues;
                break;
            default:
                if (is_array($value) && is_subclass_of($type, RestorableInterface::class)) {
                    /** @var RestorableInterface $subObject */
                    $subObject = new $type();
                    $subObject->restore($value, array_merge($subObject->getRequiredFields(), $subObject->getOptionalFields()));
                    $value = $subObject;
                    break;
                }

                throw new \UnexpectedValueException('Unknown type for restore object');
        }

        return $value;
    }
}
