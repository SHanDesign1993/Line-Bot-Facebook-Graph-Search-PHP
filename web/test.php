<?php
$count = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_get_point.php");
//$add = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_add_point.php");
//$ex = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_change_point.php");
echo $count;
$access_token = "VP7oYVhN1HwpIfvTmXhgNPQIelGQROm/WQ/dmouJ7iZRAjBgOyUNF9Aq+Y6Ds8hP1Ae5mglAhcJtaBpC7na5or3SqTqWudfWt1QPur/76ej40a3jg0wift89aYYpHSvTyohfP0yibnHLr/+Ge2F1LQdB04t89/1O/w1cDnyilFU=";

$message_obj = [
  "to" => "Ue004c4797cf171301dccf7e7d8ef7d62",
  "messages" => [
    [
      "type" => "text",
      "text" => $count."點"
    ]
  ]
];

$post_obj=array(
    'Content-Type: application/json',
    'Authorization: Bearer '.$access_token,
    //'Authorization: Bearer '. TOKEN
    $message_obj
);


$ch = curl_init("https://api.line.me/v2/bot/message/push");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $post_obj);

$result = curl_exec($ch);
print_r($post_obj);
print_r($result);
curl_close($ch);

   
?>            
