<?php


namespace Capusta\SDK\Actions;


use Capusta\SDK\Exception\Request\RequestParseException;
use Capusta\SDK\Exception\Request\UnknownRequestTypeException;
use Capusta\SDK\Exception\Request\UnsupportedRequestTypeException;
use Capusta\SDK\Model\Request\AbstractRequest;

class RequestCreator
{
    /**
     * @param string $request
     * @param array  $data
     *
     * @return AbstractRequest
     *
     * @throws UnknownRequestTypeException
     * @throws UnsupportedRequestTypeException
     * @throws RequestParseException
     */
    public static function create($request, array $data)
    {
        if (!class_exists($request)) {
            throw new UnknownRequestTypeException(sprintf('Unknown request type: %s', $request));
        }

        $request = new $request();

        if (!$request instanceof AbstractRequest) {
            throw new UnsupportedRequestTypeException(sprintf('Unsupported request type: %s', get_class($request)));
        }

        try {
            $request->restore($data, array_merge($request->getRequiredFields(), $request->getOptionalFields()));
        } catch (\Exception $e) {
            throw new RequestParseException($e->getMessage(), $e->getCode());
        }
        return $request;

    }
}
