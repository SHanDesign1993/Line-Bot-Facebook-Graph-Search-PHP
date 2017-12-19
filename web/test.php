<?php
$count = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_get_point.php");
//$add = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_add_point.php");
//$ex = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_change_point.php");
echo $count;
$access_token = "VfcdUobfc4kKV+SbzTXQDOnvBjpFIkJqla35htny9vPB+3uVC9B5Dkwy6e6eSDGjbJQyHQMVk9+W9ALd7+Px4LcmAZMxoaE1Qyvgkzk0B99Q6vQCMusoUsjR6UHtZDHzgYrNY9OYzefblJvD7CxNCwdB04t89/1O/w1cDnyilFU=";
$message_obj = [
  "to" => "Ue004c4797cf171301dccf7e7d8ef7d62",
  "messages" => [
    [
      "type" => "text",
      "text" => $count."點"
    ]
  ]
];

$header=array(
    'Content-Type:application/json' ,
    'Authorization: Bearer {$access_token}' 
);


$ch = curl_init("https://api.line.me/v2/bot/message/push");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message_obj));
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);


$result = curl_exec($ch);

echo "</br>";
print_r(json_encode($message_obj));
echo "</br>";
print_r($result);

curl_close($ch);

   
?>            
