<?php


namespace Capusta\SDK\Exception;


class JsonParseException extends \UnexpectedValueException
{
    /**
     * @inheritDoc
     */
    public function __construct($message = '', $code = 0, $headers = [], $body = null)
    {
        $jsonErrors = [
            JSON_ERROR_NONE => 'No error has occurred',
            JSON_ERROR_DEPTH => 'The maximum stack depth has been exceeded',
            JSON_ERROR_STATE_MISMATCH => 'Occurs with underflow or with the modes mismatch (invalid or malformed JSON)',
            JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
            JSON_ERROR_SYNTAX => 'Syntax error',
            JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded',
        ];

        if (isset($jsonErrors[$code])) {
            $message = sprintf('%s: %s', $message, $jsonErrors[$code]);
        }

        parent::__construct($message, $code);
    }
}
