<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <title>ACC MNS</title>
</head>
<body>

<?php 
// callout to the success webpage and get responses from the form that was filled in.
    include "mass-note-success.html";
    $postcode=$_POST["postcode"];
    $notification=$_POST["notification"]
?>

<?php

// Google Sheets API setup
error_reporting(0);
require_once __DIR__ . '/vendor/autoload.php';

$client = new \Google_Client();
$client->setApplicationName('AvayaCountyCouncilMN');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/credentials.json');
$service = new Google_Service_sheets($client);
$spreadsheetId = "1fTUpH6_sxaLMk6biYsP-2Qzjx_XvB1q9-15fBMAUjpQ";

// Filter sheets
$body = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array(
'requests' => array(
    'setBasicFilter' => array(
        'filter' => array(
            'range' => [
                'sheetId' => 0,
                'startColumnIndex' => 0,
                'endColumnIndex' => 3
            ],
            'criteria' => array(
                '2' => array(
                    'condition' => array(
                        'type' => 'TEXT_CONTAINS',
                        'values' => array(
                            'userEnteredValue' => $postcode
                        )
                    )
                )
            )
        )
    )
)
));

($service->spreadsheets->batchUpdate($spreadsheetId, $body));

// Copy and paste

$copyBody = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array(
'requests' => array(
  'copyPaste' => array(
    'source' => [
      'sheetId'=> 0
      ],
      'destination' => [
        'sheetId' => 33573623
        ],
    )
  )
));

($service->spreadsheets->batchUpdate($spreadsheetId, $copyBody));

// The A1 notation of the values to retrieve.
$range = 'Sheet3!B2:B';

$response = $service->spreadsheets_values->get($spreadsheetId, $range);

// TODO: Change code below to process the `response` object:
// echo '<pre>', print_r($response, true), '</pre>', "\n";

$realresponse = json_decode(json_encode($response), true);

require_once 'C:\xampp\htdocs\zang-php-2\connectors\Sms.php';

// Iterate through the numbers in sheets and send them one-by-one to CPaaS to send message.
foreach($realresponse['values'] as $key => $value){
    $phones = $value[0] . "," . "<br>";
    // $json_decoded = json_decode($value);
    //    $cart[] = array('numbers' => $value);
       
// try {
    # Now what we need to do is instantiate the library and set the required options
    # Credentials can be set in <path to application>/configuration/application.config.php and then connectors
    # automatically use it when getInstance is called.
    $sms = Sms::getInstance();

    $sms -> setOptions(array(
        "account_sid"   => $_ENV["ACCOUNT_SID"],
        "auth_token"    => $_ENV["AUTH_TOKEN"],
    ));

    # NOTICE: The code below will send a new SMS message.

    # Zang_Helpers::filter_e164 is a internal wrapper helper to help you work with phone numbers and their formatting
    # For more information about E.164, please visit: http://en.wikipedia.org/wiki/E.164

    $sentSms = $sms -> sendSms(array(
    'From'          => '+19179001403',
    'To'            => $phones,
    'Body'          =>  $notification,
    'AllowMultiple' => "False"
));

    # If you wish to get back the full response object/array then use:
    // echo "<pre>";
    // ($sentSms->getResponse());
    // echo "</pre>";

    
}

?>

</body>
</html>