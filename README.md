    # Capusta.Space PHP SDK
    
    Documentation: https://dev.capusta.space/
    
    ## Requirements
    
    PHP 5.5 and later.
    
    ## Dependencies
    
    The bindings require the following extensions in order to work properly:
    
    - [`curl`](https://secure.php.net/manual/en/book.curl.php), although you can use your own non-cURL client if you prefer.
    - [`json`](https://secure.php.net/manual/en/book.json.php)
    - [`mbstring`](https://secure.php.net/manual/en/book.mbstring.php) (Multibyte String)
    - [`php-fig/log`](https://github.com/php-fig/log)
    - [`guzzlehttp/psr7`](https://github.com/guzzle/psr7)
    
    Optionally
    - [`guzzlehttp/guzzle`](https://github.com/guzzle/guzzle) for use guzzle instead of cURL.
    
    ## Composer
    First, you need to install Composer to your system.
    (https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos)
    
    After Composer is installed to your system you need to run the following command:
    
    ```bash
    composer require capusta/php-sdk:@dev
    ```
    
    To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/01-basic-usage.md#autoloading):
    
    ```php
    require_once('vendor/autoload.php');
    ```
    
    If you use Composer, these dependencies should be handled automatically.
    
    ## Getting Started
    
    We recommend using the GuzzleHttp Client
    
    ### Init client
    
    ```php
    $guzzleClient = new GuzzleHttp\Client();
    $transport = new Capusta\SDK\Transport\GuzzleApiTransport($guzzleClient);
    $client = new Capusta\SDK\Client($transport);
    $client->setAuth('merchantEmail', 'token');
    ```
    
    All requests are processed in similar steps:
    1. Create request instance of `Capusta\SDK\Model\Request\AbstractRequest`
    1. Request serialization
    1. Sending a request to the server
    1. You have a response object instance of `Capusta\SDK\Model\Response\AbstractResponse` or throws exception if request fail
    
    All requests are creating by suitable objects or can be created on the basis of arrays, integers and strings
    
    #### Create payment
    
    Creating request with object
    ```php
    // Create a request object
    $createPaymentRequest = new Capusta\SDK\Model\Request\Payment\CreatePaymentRequest();
    
    // Set up $createPaymentRequest with required params
    
    try {
        /** @var Capusta\SDK\Model\Response\Payment\CreatePaymentResponse $createPaymentResponse */
        $createPaymentResponse = $client->createPayment($createPaymentRequest);
    } catch (\Exception $e) {
        // ...
    }
    ```
    
    or you can create request with array
    ```php
    $requestArray = [
        'id' => "YOUR_TRANSACTION_ID", // your ID of transaction, optional.
        'description' => "description", //optoinal
        'amount' => [
                        'amount' => 1000, //1000 = 10 RUB, *** OPTIONAL *** (if you want to get bill with any amount within limits)
                        'currency' => 'RUB' //name of currency
                    ], //array of 'amount' in minor value and 'currency'.
        'projectCode' => "code", //required, code can be taken from my.capusta.space
        'custom' => [/*...*/], // optional array key=>value, with length < 255. 
        'expire' => new DateTime('now + 1 hour'), // optional expiration datetime object (for example payment can be paid only in 1 hour)
        'sender' => [
                        'name' => 'Vasya',
                        'phone' => '+79991234567',
                        'email' => 'vasya@vasya.ru',
                        'comment' => 'this is my order'
                    ], //optional array of 'name', 'phone', 'email', 'comment'.
    ];
    
    try {
        /** @var Capusta\SDK\Model\Response\Payment\CreatePaymentResponse $createPaymentResponse */
        $createPaymentResponse = $client->createPayment($requestArray);
    } catch (\Exception $e) {
        // ...
    }
    
    if ($createPaymentResponse->getStatus()=='CREATED'){
    // redirect user to $createPaymentResponse->getPayUrl();
    }
    ```
    if you have got `$createPaymentResponse->getStatus() == 'CREATED'`, 
    then you need to redirect user to URL: `$createPaymentResponse->getPayUrl()`
    
    #### Create bill
    
    Creating request with object
    ```php
    // Create a request object
    $createBillRequest = new Capusta\SDK\Model\Request\Bill\CreateBillRequest();
    
    // Set up $createBillRequest with required params
    
    try {
        /** @var Capusta\SDK\Model\Response\Bill\CreateBillResponse $createBillResponse */
        $createBillResponse = $client->createBill($createBillRequest);
    } catch (\Exception $e) {   
        // ...
    }
    ```
    
    or you can create request with array
    ```php
    $requestArray = [
        'id' => "YOUR_BILL_ID", //optional
        'amount' => [
                        'amount' => 1000, //1000 = 10 RUB, *** OPTIONAL *** (if you want to get payment with any amount within limits)
                        'currency' => 'RUB' //name of currency
        ], //array of 'amount' in minor value and 'currency'
        'description' => "description", //optional description of bill
        'projectCode' => "code", //your project code
        'custom' => [/*...*/], // optional array of key=>value structure and length < 255.
        'expire' => new DateTime('now + 1 day'), // optional expiration datetime (for example bill can be paid within 1 day)
    ];
    // ^^^^^^^^ the same fields like in payment method.
     
    try {
        /** @var Capusta\SDK\Model\Response\Bill\CreateBillResponse $createBillResponse */
        $createBillResponse = $client->createBill($requestArray);
    } catch (\Exception $e) {
        // ...
    }
    
    if ($createBillResponse->getStatus()=='CREATED'){
            // redirect user to $createBillResponse->getPayUrl();
    }
    ```
    If you have got `$createBillResponse->getStatus() == 'CREATED'`, 
    then you need to redirect user to URL: `$createBillResponse->getPayUrl()`
    
    
    #### Create payout
    
    Creating request with object
    ```php
    // Create a request object
    $createPayoutRequest = new Capusta\SDK\Model\Request\Payout\CreatePayoutRequest();
    
    // Set up $createPayoutRequest with required params
    
    try {
        /** @var Capusta\SDK\Model\Response\Payout\CreatePayoutResponse $createPayoutResponse */
        $createPayoutResponse = $client->createPayout($createPayoutRequest);
    } catch (\Exception $e) {
        // ...
    }
    ```
    
    or you can create request with array
    ```php
    $requestArray = [
        'id' => 'transaction_id', // optional
        'amount' => [
                        'amount' => 1000, //1000 = 10 RUB
                        'currency' => 'RUB' //name of currency
        ], // array of 'currency' and 'amount' in minor value
        'projectCode' => 'ProjectCode', // or 'projectId' => projectId
        'pan' => 'payout card number', // i.e. 4111111111111111
        'description' => 'my payout description',  //optional
    ];
    
    try {
        /** @var Capusta\SDK\Model\Response\Payout\CreatePayoutResponse $createPayoutResponse */
        $createPayoutResponse = $client->createPayout($requestArray);
    } catch (\Exception $e) {
        // ...
    }
    ```
    
    #### Getting payment status
    
    Creating request with object
    ```php
    // Create a request object
    $getStatusRequest = new Capusta\SDK\Model\Request\Status\GetStatusRequest();
    
    // Set up $getStatusRequest with required params
    
    try {
        /** @var Capusta\SDK\Model\Response\Status\getStatusResponse $getStatusResponse */
        $getStatusResponse = $client->getStatus($getStatusRequest);
    } catch (\Exception $e) {
        // ...
    }
    ```
    
    or you can create request with array
    ```php
    $requestArray = [
        'transaction_id' => 'YOUR_TRANSACTION_ID', // here is the id of the transaction
    ];
    
    try {
        /** @var Capusta\SDK\Model\Response\Status\getStatusResponse $getStatusResponse */
        $getStatusResponse = $client->getStatus($requestArray);
    } catch (\Exception $e) {
        // ...
    }
    ```
    
     #### Getting BILL status 
     (with array of successfull payments inside of 'transactions' property)
        
        Creating request with object
        ```php
        // Create a request object
        $getBillStatusRequest = new Capusta\SDK\Model\Request\Status\GetStatusRequest();
        
        // Set up $getStatusRequest with required params
        
        try {
            /** @var Capusta\SDK\Model\Response\Status\getStatusResponse $getStatusResponse */
            $getStatusResponse = $client->getBillStatus($getBillStatusRequest);
        } catch (\Exception $e) {
            // ...
        }
        ```
        
        or you can create request with array
        ```php
        $requestArray = [
            'transaction_id' => 'YOUR_TRANSACTION_ID', // here is the id of the transaction
        ];
        
        try {
            /** @var Capusta\SDK\Model\Response\Status\getStatusResponse $getStatusResponse */
            $getStatusResponse = $client->getBillStatus($requestArray);
        } catch (\Exception $e) {
            // ...
        }
        ```
        
        If you want to get array of successfull transactions of bill or payment 
        you need to call method $getStatusResponse->getTransactions(). 
    #### Getting payments registry
    
    Array of successfull payments. 
    NOTE: Difference between from and to dates not be more than 24 hours.
    ```php
    $registry = new Capusta\SDK\Model\Request\Registry\GetRegistryRequest();
    $registry->setFrom(new \DateTime('1 day ago'))
                ->setTo(new \DateTime())
                ->setProjectCode('projectCode');
    
    $response = $client->getRegistry($registry);
    
    ```
    or you can get payments registry with array request
    ```php
    $requestArray = [
        'projectCode' => 'projectCode', // here is the id of the transaction
        'from' => '2020-04-30T08:19:47.000-04:00', // start date
        'to' => '2020-05-01T08:19:47.000-04:00',
    ];
    
    try {
        /** @var $getRegistryResponse array */
        $getRegistryResponse = $client->getRegistry($requestArray);
    } catch (\Exception $e) {
        // ...
    }
    ```
    
    #### Create project 
    (this method is disabled by default, you need to ask support to switch this on)
    
    Creating request with object
    ```php
    // Create a request object
    $createProjectRequest = new Capusta\SDK\Model\Request\Project\CreateProjectRequest();
    
    // Set up $createProjectRequest with required params
    
    try {
        /** @var Capusta\SDK\Model\Response\Project\CreateProjectResponse $createProjectResponse */
        $createProjectResponse = $client->createProject($createProjectRequest);
    } catch (\Exception $e) {   
        // ...
    }
    ```
    
    or you can create request with array
    ```php
    $requestArray = [
        'email' => 'email@email.org',
        'projectLink' => "https://project.link", // URL of the project site
        'callbackUrl' => "https://project.link/callback", // callback address
        'failUrl' => "https://project.link/fail", //failed transactions redirect URL
        'successUrl' => "https://project.link/success", //success transactions redirect URL
    ];
     
    try {
        /** @var Capusta\SDK\Model\Response\Project\CreateProjectResponse $createProjectResponse */
        $createProjectResponse = $client->createProject($requestArray);
    } catch (\Exception $e) {
        // ...
    }
    ```
    returned object $dreateProjectResponse contains properties within the 'status' property. 
    If 'status' is "NEW" - the project is successfully created.
    
    #### Exceptions
    
    - `Capusta\SDK\Exception\TransportException` - throws in the case of an api transport error. For example, when authorization data is not provided.
    - `Capusta\SDK\Exception\JsonParseException` - the server response doesn't contain a valid json.
    - `Capusta\SDK\Exception\ServerResponse\ResponseException` - 4xx and 5xx server errors.
    - `Capusta\SDK\Exception\Response\ResponseParseException` - create response errors.
    - `Capusta\SDK\Exception\Request\RequestParseException` - create request errors.
    
    ### Processing notification from server
    
    This code is responsible for processing the payment result.
    You need to create handler, make it available on URL in your application and specify the URL in the project settings in [my.capusta.space](http://my.capusta.space).
    This handler will be called after the user makes a payment using the form on capusta.space
    
    ```php
    $notification = new \Capusta\SDK\Notification();
    $notification->setAuth('merchantEmail', 'token');
    $responseNotification = $notification->process();
    ```
    $responseNotification contains object with notification parameters.
    
    You can use manual response to server:
    
    ```php
    $notification->process(false);
    
    // if success
    $notification->successResponse();
    // if error
    $notification->errorResponse('Error message');
    ```
    
    If you use a proxy server, you can skip the IP check
    
    ```php
    $notification->setSkipIpCheck();
    ```
    
    ## Custom Api Transport
    
    You can create your own api transport by extending `Capusta\SDK\Transport\AbstractApiTransport`
    
    ```php
    class MyApiTransport extends \Capusta\SDK\Transport\AbstractApiTransport {
        protected function sendRequest(Psr7\Request $request) {
            // Implementing the sendRequest() method
        }
    }
    ```
