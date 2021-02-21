<?php
include_once('XmppPrebind.php');
$username = "ajit";
$password = "contec";

$xmppPrebind = new XmppPrebind('anair.tld', 'http://ajit-pc.abvenis.com:7070/http-bind/', 'ajit', false, false);
$xmppPrebind->connect($username, $password);
$xmppPrebind->auth();
$sessionInfo = $xmppPrebind->getSessionInfo(); // array containing sid, rid and jid

print_r($sessionInfo);

?>