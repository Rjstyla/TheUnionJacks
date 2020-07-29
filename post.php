<?php
require_once 'C:\xampp\htdocs\zang-php-2\connectors\Sms.php';
$url = 'https://aaa-gateway-service.preprod.relayplus.com/auth/realms/relayplus/protocol/openid-connect/token';
$data = array('client_id' => 'm-8007', 'client_secret' => '89bba002-46ac-493a-8864-fe45f96add11', 'username' => 'avaya_api', 'password' => '192f4170-0185-437c-8a3c-3fc81c0eafC9',  'grant_type' => 'password');

// use key 'http' even if you send the request to https://... https://www.youtube.com/watch?v=TSIp-rmxOws
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */ }


$fp = fopen('results.json', 'w');
fwrite($fp, json_encode($result));
fclose($fp);

//grabs only the access_token
$obj = json_decode($result);
$access = $obj->access_token;
//echo ($access);
?>

<?php
//transact link
$amount = $_POST["money"];
$number = $_POST["phone_number"];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://link-management-service.preprod.relayplus.com/api/v1/links/transact",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>"<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n<CreateTransactLinkRequest>\r\n<!--\tCOMMENT/UNCOMMENT NEEDED OPTION\t\t-->\t\r\n<!--\tGENERAL PROPERTIES\t\t-->\t\r\n\t<merchantPaymentConfigId>80070001</merchantPaymentConfigId>\r\n\t<binListServiceRulesetId>3040</binListServiceRulesetId>\r\n\r\n\t<linkLifetime>300000</linkLifetime>\r\n\t<vlnLength>20</vlnLength>\r\n\r\n\t<displayParameters>\r\n\t\t<displayType>STANDALONE</displayType>\r\n\t\t<!--<displayType>IFRAME</displayType>-->\r\n\t\t<!--<allowFromUri>https://www.w3schools.com</allowFromUri>-->\r\n\t\t<styleId>en</styleId>\r\n\t</displayParameters>\r\n\r\n<!--\tTRANSACTION PROPERTIES\t\t-->\t\r\n\t<transactionAmount>$amount</transactionAmount>\r\n\t<!--<transactionMaxAmount>100000</transactionMaxAmount>-->\r\n\t<!--<transactionMinAmount>0.01</transactionMinAmount>-->\r\n\t<transactionCurrency>GBP</transactionCurrency>\r\n\t<transactionPurpose>Some Transaction Purpose</transactionPurpose>\r\n\t<transactionVerb>PAY_TO</transactionVerb>\r\n\r\n<!--\tADDITIONAL TRANSACTION PARAMETERS\t-->\t\r\n\t<!--<clientBin>411111</clientBin>-->\r\n\t<pspParameters>\r\n        <entry>\r\n            <key>transactionReference</key>\r\n            <value>TRID_1592822341</value>\r\n        </entry>\r\n        <!--<entry>-->\r\n        <!--    <key>token</key>-->\r\n        <!--    <value>P7V0D9E7G6C1K1B</value>-->\r\n        <!--</entry>-->\r\n\t</pspParameters>\r\n\r\n<!--\tTRANSACTION TYPE - WORLDPAY\t- PAYMENT-->\r\n   <transactionType>PaymentAuthSettlePan</transactionType>\r\n    <!--<transactionType>PaymentAuthSettlePanSecurityCode</transactionType>-->\r\n    <!--<transactionType>PaymentAuthPan</transactionType>-->\r\n    <!--<transactionType>PaymentAuthPanSecurityCode</transactionType>-->\r\n    <!--<transactionType>PaymentAuthSettleToken</transactionType>-->\r\n        <!--<transactionType>PaymentAuthSettleTokenSecurityCode</transactionType>-->\r\n    <!--<transactionType>PaymentAuthToken</transactionType>-->\r\n    <!--<transactionType>PaymentAuthTokenSecurityCode</transactionType>-->\r\n\r\n<!--\tACCESS RESTRICTIONS\t\t-->\t\r\n\t<usageLimit>100</usageLimit>\r\n\t<paymentAttemptLimit>50</paymentAttemptLimit>\r\n\t<maxAccessFailures>20</maxAccessFailures>\r\n\r\n<!--\tPASSCODE RESTRICTIONS\t\t-->\t\r\n\t<passcodeRequired>false</passcodeRequired>\r\n\t<!--<passcodeRequired>true</passcodeRequired>-->\r\n\t<!--<maxPasscodeAttempts>2</maxPasscodeAttempts>-->\r\n\t<!--<passcodeGeneratorLength>20</passcodeGeneratorLength>-->\r\n\t<!--<passcodeGeneratorCharset>ALPHA_NUMERIC</passcodeGeneratorCharset>-->\r\n\t<!--<passcodeGeneratorCharset>ALPHA_ONLY</passcodeGeneratorCharset>-->\r\n\t<!--<passcodeGeneratorCharset>NUMERIC_ONLY</passcodeGeneratorCharset>-->\r\n\r\n<!--\tIP/GEO-IP RESTRICTIONS\t\t-->\t\r\n\t<ipRestrictionType>NONE</ipRestrictionType>\r\n\t<!--<ipRestrictionType>EXACT_MATCH</ipRestrictionType>-->\r\n\t<!--<ipRestrictionType>GEOIP_RESTRICTION</ipRestrictionType>-->\r\n\t<!--<ipAddress>195.160.235.253</ipAddress>-->\r\n\t<!--<geoIpRadius>20</geoIpRadius>-->\r\n\r\n<!--\tUSER AGENT RESTRICTIONS\t\t-->\t\r\n\t<userAgentRestrictionType>NONE</userAgentRestrictionType>\r\n\t<!--<userAgentRestrictionType>EXACT_MATCH</userAgentRestrictionType>-->\r\n\t<!--<userAgentString>Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0</userAgentString>-->\r\n\r\n    <!--\tPUSH TRANSACTION STATUS ENDPOINT\t\t-->\r\n    <pspTransactionUpdatesEndpoint>https://webhook.site/e97beb5d-e4ce-41a7-b013-9afc21718386</pspTransactionUpdatesEndpoint>\r\n     <pspTransactionUpdatesSessionKey>5e55s10nkey</pspTransactionUpdatesSessionKey>\r\n    <!-- <capturePageParameters>-->\r\n    <!--  <additionalRequired>-->\r\n    <!--        <parameter>avsCountry</parameter>-->\r\n    <!--  </additionalRequired>-->\r\n    <!--  <additionalOptional>-->\r\n    <!--        <parameter>avs2</parameter>-->\r\n    <!--  </additionalOptional>-->\r\n    <!--</capturePageParameters>-->\r\n    \r\n\t<pspTransactionUpdatesHeaders>\r\n\t\t\t<entry>\r\n\t            <key>Authorization</key>\r\n\t            <value>Basic bWVyY2hhbnQxX2FnZW50OjE=</value>\r\n\t        </entry>\r\n\t</pspTransactionUpdatesHeaders>\r\n    \tPUSH NOTIFICATIONS ENDPOINT\t\t\r\n    <linkProgressUpdatesEndpoint>https://webhook.site/e97beb5d-e4ce-41a7-b013-9afc21718386</linkProgressUpdatesEndpoint>\r\n    <linkProgressUpdatesSessionKey>5e55s10nkey</linkProgressUpdatesSessionKey>\r\n\t<linkProgressUpdatesHeaders>\r\n\t\t\t<entry>\r\n\t            <key>Authorization</key>\r\n\t            <value>Basic bWVyY2hhbnQxX2FnZW50OjE=</value>\r\n\t        </entry>\r\n\t</linkProgressUpdatesHeaders>\r\n</CreateTransactLinkRequest>",
  CURLOPT_HTTPHEADER => array(
    "Accept: application/xml",
    "Content-Type: application/xml",
    "Authorization: Bearer $access"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
?>

<?php

$xml = simplexml_load_string($response);
$link = (string)$xml->link;
echo "\r \n";
$reference = (string)$xml->linkReferenceId;
echo "This is the link reference ID for the agent: $reference";
//echo($link);
// echo "You have now just recieved an sms, please click on the link to go to our payment page";

?>

<?php
try {

    $sms = Sms::getInstance();

    $sms -> setOptions(array(
        "account_sid"   => $_ENV["ACCOUNT_SID"],
        "auth_token"    => $_ENV["AUTH_TOKEN"],
    ));


    $sentSms = $sms -> sendSms(array(
        'From'          => '+19892560080',
        'To'            => $number,
        'Body'          => "This is the link to your payment site: $link",
        'AllowMultiple' => "False"
    ));

  //  echo "<pre>";
  //  print_r($sentSms->getResponse());
  //  echo "</pre>";


} catch (ZangException $e){
  //  echo "<pre>";
  //  print_r( "Exception message: " . $e -> getMessage() . "<br>");
  //  print_r( "Exception code: " . $e -> getCode() . "<br>");
  //  print_r(  $e -> getTrace() );
  //  echo "</pre>";
  }
?>
