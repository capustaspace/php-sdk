<?php


namespace Capusta\SDK\Utils;


class AccessorUtil
{
    public static function property($text)
    {
        //$text = strtolower($text);

        return lcfirst(str_replace(' ', '', ucwords($text)));
    }

    public static function getter($text)
    {
        return 'get' . self::property($text);
    }

    public static function isser($text)
    {
        return 'is' . self::property($text);
    }

    public static function adder($text)
    {
        return 'add' . self::property($text);
    }
}
