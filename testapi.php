<?php
include "vendor/autoload.php";

$authenticationToken = new \Gnello\OpenFireRestAPI\AuthenticationToken('VcnZl4Ba672zJSYK');
$api = new \Gnello\OpenFireRestAPI\API('ajit-pc.abvenis.com', 9090, $authenticationToken);

$api->Settings()->setServerName("ajit-pc.abvenis.com");
$api->Settings()->setHost("ajit-pc.abvenis.com");
$api->Settings()->setPort("9090");
$api->Settings()->setSSL(false);
$api->Settings()->setPlugin("/plugins/restapi/v1");


use \Gnello\OpenFireRestAPI\Settings\SubscriptionType;
//$properties = array('key1' => 'VcnZl4Ba672zJSYK', 'key2' => '');
$properties = array('key1' => 'value1', 'key2' => 'value2');
$user =  "gyanesh";

$result = $api->Users()->createUser($user, 'contec', $user, 'gyaneshs@outlook.com', $properties);

print_r($result);
if($result['response']) {
    echo "success";
} else {
    echo 'Error!';
}





//$result = $api->Sessions()->retrieveAllUserSession();
$jid = rand();

$result = $api->Users()->createUserRosterEntry('ajit', $jid, 'Ajit', SubscriptionType::BOTH, array('group1','group2'));





$result = $api->Users()->retrieveUsers('ajit');



$result = $api->Messages()->sendBroadcastMessage('Hi everybody!');

echo "<pre>";
//print_r(json_encode($result));

print_r(json_encode($result));
?>