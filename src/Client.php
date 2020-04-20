<?php


namespace Capusta\SDK;


use GuzzleHttp\Psr7;
use Capusta\SDK\Actions\RequestCreator;
use Capusta\SDK\Actions\ResponseCreator;
use Capusta\SDK\Exception\JsonParseException;
use Capusta\SDK\Exception\Request\RequestParseException;
use Capusta\SDK\Exception\Response\ResponseParseException;
use Capusta\SDK\Exception\ServerResponse\BadRequestException;
use Capusta\SDK\Exception\ServerResponse\ForbiddenException;
use Capusta\SDK\Exception\ServerResponse\InternalServerException;
use Capusta\SDK\Exception\ServerResponse\NotFoundException;
use Capusta\SDK\Exception\ServerResponse\RequestTimeoutException;
use Capusta\SDK\Exception\ServerResponse\ResponseException;
use Capusta\SDK\Exception\ServerResponse\TooManyRequestsException;
use Capusta\SDK\Exception\ServerResponse\UnauthorizedException;
use Capusta\SDK\Exception\TransportException;
use Capusta\SDK\Model\Request\AbstractRequest;
use Capusta\SDK\Model\Request\AbstractRequestTransport;

use Capusta\SDK\Model\Request\Payment\CreatePaymentRequest;
use Capusta\SDK\Model\Request\Payment\CreatePaymentSerializer;
use Capusta\SDK\Model\Request\Payment\CreatePaymentTransport;

use Capusta\SDK\Model\Request\Bill\CreateBillRequest;
use Capusta\SDK\Model\Request\Bill\CreateBillSerializer;
use Capusta\SDK\Model\Request\Bill\CreateBillTransport;

use Capusta\SDK\Model\Request\Status\GetStatusRequest;
use Capusta\SDK\Model\Request\Status\GetStatusSerializer;
use Capusta\SDK\Model\Request\Status\GetStatusTransport;

use Capusta\SDK\Model\Request\Payout\CreatePayoutRequest;
use Capusta\SDK\Model\Request\Payout\CreatePayoutSerializer;
use Capusta\SDK\Model\Request\Payout\CreatePayoutTransport;

use Capusta\SDK\Model\Response\AbstractResponse;
use Capusta\SDK\Model\Response\Payment\CreatePaymentResponse;
use Capusta\SDK\Model\Response\Bill\CreateBillResponse;

use Capusta\SDK\Model\Response\Payout\CreatePayoutResponse;
use Capusta\SDK\Model\Response\Status\GetStatusResponse;

use Capusta\SDK\Transport\AbstractApiTransport;
use Capusta\SDK\Transport\Authorization\TokenAuthorization;
use Capusta\SDK\Transport\CurlApiTransport;
use Capusta\SDK\Actions\ObjectRecursiveValidator;

class Client
{
    const VERSION = '1.0.6';

    /** @var AbstractApiTransport */
    private $apiTransport;

    public function __construct(AbstractApiTransport $apiTransport = null)
    {
        $this->apiTransport = $apiTransport;
        if (!$this->apiTransport) {
            $this->apiTransport = new CurlApiTransport();
        }
    }

    /**
     * @param $merchantEmail
     * @param $token
     */
    public function setAuth($merchantEmail, $token)
    {
        $auth = new TokenAuthorization($merchantEmail, $token);
        $this->apiTransport->setAuth($auth);
    }


    /**
     * @param CreatePaymentRequest|AbstractRequest|array $payment
     *
     * @return CreatePaymentResponse|AbstractResponse
     *
     * @throws TransportException
     * @throws JsonParseException
     * @throws ResponseException
     * @throws ResponseParseException
     * @throws RequestParseException
     */
    public function createPayment($payment)
    {
        if (is_array($payment)) {
            $payment = RequestCreator::create(CreatePaymentRequest::class, $payment);
        }
        ObjectRecursiveValidator::validate($payment);
        $paymentSerializer = new CreatePaymentSerializer($payment);
        $paymentTransport = new CreatePaymentTransport($paymentSerializer);
        return $this->execute($paymentTransport, CreatePaymentResponse::class);
    }

    /**
     * @param GetStatusRequest|AbstractRequest|array $status
     *
     * @return GetStatusResponse|AbstractResponse
     *
     * @throws TransportException
     * @throws JsonParseException
     * @throws ResponseException
     * @throws ResponseParseException
     * @throws RequestParseException
     */
    public function getStatus($status)
    {
        if (is_array($status)) {
            $status = RequestCreator::create(GetStatusRequest::class, $status);
        }
        ObjectRecursiveValidator::validate($status);
        $statusSerializer = new GetStatusSerializer($status);
        $statusTransport = new GetStatusTransport($statusSerializer);
        return $this->execute($statusTransport, GetStatusResponse::class);
    }

    /**
     * @param CreateBillRequest|AbstractRequest|array $bill
     *
     * @return CreateBillResponse|AbstractResponse
     *
     * @throws TransportException
     * @throws JsonParseException
     * @throws ResponseException
     * @throws ResponseParseException
     * @throws RequestParseException
     */
    public function createBill($bill)
    {
        if (is_array($bill)) {
            $bill = RequestCreator::create(CreateBillRequest::class, $bill);
        }

        ObjectRecursiveValidator::validate($bill);
        $billSerializer = new CreateBillSerializer($bill);
        $billTransport = new CreateBillTransport($billSerializer);

        return $this->execute($billTransport, CreateBillResponse::class);
    }

    /**
     * @param CreatePayoutRequest|AbstractRequest|array $payout
     *
     * @return CreatePayoutResponse|AbstractResponse
     *
     * @throws TransportException
     * @throws JsonParseException
     * @throws ResponseException
     * @throws ResponseParseException
     * @throws RequestParseException
     */
    public function createPayout($payout)
    {
        if (is_array($payout)) {
            $payout = RequestCreator::create(CreatePayoutRequest::class, $payout);
        }

        ObjectRecursiveValidator::validate($payout);
        $payoutSerializer = new CreatePayoutSerializer($payout);
        $payoutTransport = new CreatePayoutTransport($payoutSerializer);
        return $this->execute($payoutTransport, CreatePayoutResponse::class);
    }


    /**
     * @param AbstractRequestTransport $requestTransport
     * @param string                   $responseType
     *
     * @return AbstractResponse
     *
     * @throws ResponseException
     * @throws TransportException
     * @throws ResponseParseException
     * @throws JsonParseException
     */
    protected function execute(AbstractRequestTransport $requestTransport, $responseType)
    {
        $response = $this->apiTransport->send(
            $requestTransport->getPath(),
            $requestTransport->getMethod(),
            $requestTransport->getQueryParams(),
            json_encode($requestTransport->getBody()),
            $requestTransport->getHeaders()
        );

        if ($response->getStatusCode() != 200) {
            $this->processError($response); // throw ResponseException
        }

        $responseData = json_decode($response->getBody(), true);

        if (!$responseData) {
            throw new JsonParseException('Decode response error', json_last_error());
        }
        return ResponseCreator::create($responseType, $responseData);
    }


    /**
     * @param Psr7\Response $response
     *
     * @throws ResponseException
     */
    protected function processError(Psr7\Response $response)
    {
        $content = $response->getBody()->getContents();

        switch ($response->getStatusCode()) {
            case BadRequestException::HTTP_CODE:
                throw new BadRequestException($response->getHeaders(), $content);
            case UnauthorizedException::HTTP_CODE:
                throw new UnauthorizedException($response->getHeaders(), $content);
            case ForbiddenException::HTTP_CODE:
                throw new ForbiddenException($response->getHeaders(), $content);
            case NotFoundException::HTTP_CODE:
                throw new NotFoundException($response->getHeaders(), $content);
            case RequestTimeoutException::HTTP_CODE:
                throw new RequestTimeoutException($response->getHeaders(), $content);
            case TooManyRequestsException::HTTP_CODE:
                throw new TooManyRequestsException($response->getHeaders(), $content);
            case InternalServerException::HTTP_CODE:
                throw new InternalServerException($response->getHeaders(), $content);
            default:
                throw new ResponseException(
                    'An unknown API error occurred',
                    $response->getStatusCode(),
                    $response->getHeaders(),
                    $content
                );
        }
    }
}
