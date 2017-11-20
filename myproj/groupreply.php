<?php

$addr = "172.23.32.154:8000";
$path = "/api/v1/users/groupreply";
$baseUrl = "$addr$path";
$ch = curl_init($baseUrl);
//$ch = curl_init($baseUrl . "/delete/");

$data_array = array(
  "profil"   => "GP",

  "data"      => array(
    "value"  =>  "test-value",
    "ipv4"        => "130.130.100.108",
    "groupname"  =>  "ctx-GP-1G",
    "attribute"  => "test-attribute",
    "op" =>  ":="

  )
);

$data_string = json_encode($data_array);

print_r($data_array['data']['ipv6']['ipv6Prefix']);


$header = array('Content-Type: application/json',
  'Content-Length: ' . strlen($data_string));

curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_POST, TRUE);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);




echo "Executing connection\n";

$res = curl_exec($ch);
curl_close($ch);

echo "\n";
if (!$res)
  print_r("Res est super\n");
else
  print_r($res);
echo "\nConnection done.\n";

?>
