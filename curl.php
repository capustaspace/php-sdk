<?php
$email = 'YOUR_EMAIL_HERE';
$token = 'YOUR_TOKEN_HERE';
$projectCode = 'YOUR_PROJECT_CODE_HERE';
$amount = 1000; //minimum 10 rub!

$headers = [
    'Authorization: Bearer '.$email . ':' . $token,
    'Content-Type: application/json; charset=utf-8',
];

$url = "https://api.capusta.space/v1/partner/payment"; //payment url
$requestArray = [
    'projectCode' => $projectCode,
    'amount' => [
        'currency' => 'RUB',
        'amount' => $amount,
    ],
    'description' => 'its easy, man!',
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($requestArray));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close ($ch);

print  $server_output ;