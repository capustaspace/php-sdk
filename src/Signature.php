<?php

namespace Capusta\SDK;

class Signature
{
    /**
     * @param $request array
     * @param $merchantEmail string
     * @param $token string
     * @return bool
     */
    public static function check(array $request, $merchantEmail, $token): bool
    {
        $signature = $request['signature'];

        $flatted = self::flatten($request);
        ksort($flatted);

        $string = self::stringify($flatted) . $merchantEmail.$token;
        $resultSignature = md5($string);
        return  $signature == $resultSignature;
    }

    /**
     * converts multi-fivensional array to assoc array
     * @param $array
     * @param string|null $mkey
     * @return array
     */
    protected static function  flatten($array, string $mkey = null): array
    {
        $return = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $return = array_merge($return, self::flatten($value, $key));
            } else {
                if (is_null($mkey)) {
                    $rkey = $key;
                } else {
                    $rkey = $mkey . '_' . $key;
                }
                if (!is_null($value) && $rkey !== 'signature') {
                    $return[$rkey] = $value;
                }
            }
        }

        return $return;
    }

    /**
     * Converts array to string
     * @param $array
     * @return string
     */
    protected static function stringify(array $array): string
    {
        $return = '';
        foreach ($array as $key => $value) {
            $value = is_bool($value) ? ($value ? 'true' : 'false') : $value;
            $return .= $key . $value;
        }
        return $return;
    }

}