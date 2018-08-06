<?php
require_once dirname(__FILE__) . '/src/QsnarkSDK.php';

use qulian\qsnark\sdk\QsnarkSDK as Qsnark;

$qsnark = new Qsnark(array(
  'phone' => "17826856303",
  'password' => "qwertyuiop123",
  'client_id' => "0b6fca28-d7bb-414a-be12-d573db72dfcb",
  'client_secret' => "7z6Vlk58450s27FJdHW2Q9zIkh4P4RFR",
));

$start = 1483228800000;
$end = 1514764800000;
$response = $qsnark->transaction->query_all_illegal_transactions($start, $end);
