
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>LINE PushMessager</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
</head>
<style>
@import url(https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700,600);
* {
  outline:none;
}
body {
  background-image: url(https://www.sankalpcs.com/images/sliders/master/slider-bg.jpg);
  background-color:#333;
  font-family: 'Open Sans', sans-serif;
}
#pizza {
  width:600px;
  margin: 0;
  background-image:url(https://subtlepatterns.com/patterns/purty_wood.png);
  box-sizing:border-box;
  padding: 24px 30px 14px 30px;
  border-radius:8px 8px 0 0;
  background-color:#EAC995;
  border:1px solid #EAC995;
  box-shadow: inset 0 0 20px rgba(0,0,0,0.4);
}
textarea {
  box-sizing:border-box;
  width:100%;
  min-width:100%;
  max-width:100%;
  border-radius:4px;
  border:none;
  height:100px;
  box-shadow:inset 0 0 14px rgba(0,0,0,0.2), 0 0 14px rgba(0,0,0,0.2);
  padding:8px;
  font-size:14px;
  color:#444;
  font-family: 'Courier New', 'Courier', monospace;
  transition: box-shadow 0.2s ease;
}
textarea:focus {
  box-shadow:inset 0 0 16px rgba(0,0,0,0.24), 0 0 14px rgba(0,0,0,0.2); 
}
input, .button {
  margin-top:10px;
  border:none;
  margin-right:10px;
  display: block;
  float:left;
  background-color: #1B79C7;
  line-height: 1;
  padding: 6px 20px 6px 20px;
  color: white;
  text-shadow: 0px -1px 0px #0C3658;
  border-radius: 4px;
  box-shadow: 0px 3px 0px #0C3658, 0px 3px 14px rgba(0,0,0,0.6);
  transition: background-color 0.1s ease;
  font-family: 'Open Sans', sans-serif;
  font-weight:600;
  font-size:14px;
  text-decoration:none !important;
  cursor:pointer;
  position:relative;
}
input, .button-sm{
  margin-top:10px;
  border:none;
  margin-right:10px;
  display: block;
  float:left;
  background-color: #9ACD32;
  line-height: 1;
  padding: 6px 6px 6px 6px;
  color: white;
  border-radius: 4px;
  box-shadow: 0px 3px 0px #0C3658, 0px 3px 14px rgba(0,0,0,0.6);
  transition: background-color 0.1s ease;
  font-family: 'Open Sans', sans-serif;
  font-weight:600;
  font-size:14px;
  text-decoration:none !important;
  cursor:pointer;
  position:relative;
}
input:hover, .button:hover {
  background-color: #2E92E2;
}
input:active, .button:active {  
  bottom: -2px;
  box-shadow: 0px 1px 0px #0C3658, 0px 2px 14px rgba(0,0,0,0.6);
  color: white;
}
#wfont{
  color: white;
  font-weight:600;
  font-size:14px;
}
#hamburger {
  width:600px;
  margin:0;
  box-sizing:border-box;
  padding: 20px 30px 20px 30px;
  border-radius:0 0 8px 8px;
  background-color:#444;
  border:1px solid #444;
  box-shadow: inset 0 0 20px rgba(0,0,0,0.4);
  background-image:url(http://i.imgur.com/hJcZOWD.jpg);
  color:#FFF;
  text-shadow:0px 1px 5px #000;
  font-size:14px;
}
#table {
  width:600px;
  margin:40px auto 20px auto;
  border-radius:8px;
  box-shadow: 0px 2px 20px rgba(0,0,0,0.5);
}
#pizza:after {
    content: '';
    display: table;
    clear: both;
}
#table a {
  color:#FFF;
  text-decoration:underline;
}
</style>
<script language=JavaScript>
    $( document ).ready(function() {
        $('.button').click(function () {
            $('#hamburger').html($('textarea').val());
        });
        $('#person1').click(function () {
            $('#personname').val('Henry');
        });
        $('#person2').click(function () {
            $('#personname').val('Tangya');
        });
        
        $('#exchange').click(function () {
             $.ajax({
                type: "POST",
                url: 'index.php',
                data: {functionname: 'exchange'},
                success: function (obj, textstatus) {
                     alert('兌換成功！');
                }
            });
        });
        
        $('#food').click(function () {
         
             $.ajax({
                type: "POST",
                url: 'index.php',
                data: {functionname: 'food',search: $('#comment').val()},
                success: function (obj, textstatus) {
                     console.log(obj);
                }
            });
        });
        //$('textarea').autosize();
    });
</script>
<body>
<div id="table">
<div id="pizza">
<form method="post" action="index.php">
<input style="padding:3.5px;" name="person" type="text" value="" id="personname" placeholder="Choose Person To Send..."/> 
<a class="button-sm" id="person1">Henry</a>
<a class="button-sm" id="person2">Tangya</a>
<textarea name="comment" placeholder="type someting..."></textarea>
<input type="submit" value="送出">
<!--<a class="button">Preview</a>-->
<a class="button" id="exchange">兌換點數</a>
<!--<a class="button" id="food">Push Food</a>-->
</form>
</div>
<div id="hamburger"> 
<?php
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$to_me="U4a26dead451bc002afd416b24050216c";
$to_ya="Ua24ab88b9e3bfb642ff83ef4fc1cd893";
    
$MESSAGE_TO_SEND = @$_POST['comment'];
$PERSON_TO_SEND = @$_POST['person'];
$FUNC_NAME = @$_POST['functionname'];
$FUNC_KEY = @$_POST['search'];

if(isset($MESSAGE_TO_SEND)){
    if($PERSON_TO_SEND=="Tangya"){
        PushMessage($to_ya,$MESSAGE_TO_SEND,$channelAccessToken);
    }else{
        PushMessage($to_me,$MESSAGE_TO_SEND,$channelAccessToken);    
    }
    echo "<span id='wfont'>訊息：".$MESSAGE_TO_SEND." 成功發送!</span>";
}
    
$ajaxResult = array();
if(!isset($FUNC_NAME)){ $ajaxResult['error'] = 'No function name!'; }
if(!isset($ajaxResult['error'])){
    switch($FUNC_NAME) 
    {
       case 'exchange':
           ChangePoints();
       break;
            
       default:   
           $ajaxResult['error'] = $FUNC_NAME.' Not found !';
       break;
     }
}
    
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            $userid =  $event['source']['userId'];
            
            switch ($message['type']) {
                 /* text message */
                case 'text':
                    $m_message = $message['text'];
                    $r_message='';
                     /* weather */
                    if(strpos( $message['text'], '天氣' ) !== false){
                        PushWeather($to_me,"高雄旗津",$channelAccessToken);
                        PushWeather($to_ya,"高雄前鎮",$channelAccessToken);
                    }
                    /* identity */
                    else if(strpos( $message['text'], 'who' ) !== false){
                       if($userid==$to_me){
                            PushMessage($to_me,"you are Handsome Henry:)",$channelAccessToken);
                       }else{
                            PushMessage($to_ya,"you are Beautiful Tangya:)",$channelAccessToken);
                       }
                    }
                     /* Tangya Talk */
                    if($userid==$to_ya){
                        //you talk
                        PushMessage($to_me,$m_message,$channelAccessToken);
                        
                        /* check point */
                        if( strpos( $message['text'], '點數' ) !== false || strpos( $message['text'], '查' ) !== false)
                        {
                            $count = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_get_point.php");
                            $r_message='你現在總共有 '.$count.' 點!'.unichr(0x1000B6);
                        }
                        /* get point */
                        else if( strpos( $message['text'], '愛你' ) !== false || strpos( $message['text'], 'ok' ) !== false)
                        {
                            PushMessage($to_ya,"Love u too >3<",$channelAccessToken);
                            $add = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_add_point.php");
                            $count = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_get_point.php");
                            if($add=='ok'){
                              $r_message='你爭氣的獲得了1點! (共 '.$count.'點)'.unichr(0x100022);
                            }else{
                              $r_message='你今天拿過點數了! '.unichr(0x10000E);
                            }
                        }
                    }
                	if($m_message!="")
                	{
                		$client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => $r_message
                            )
                        )
                        ));
                	}
                break;
                /* sticker message */
                case 'sticker':
                if($userid==$to_ya){
                    $r_message='Sticker';
                    PushMessage($to_me,$r_message,$channelAccessToken);
                }
                break;
                /*location message*/
                case 'location';
                    $r_message='我找找附近美食...';
                        $client->replyMessage(array(
                            'replyToken' => $event['replyToken'],
                            'messages' => array(array('type' => 'text','text' => $r_message))));
                        $lat=$message['latitude'];
                        $lon=$message['longitude'];
                        $access_key =  file_get_contents('http://140.117.6.187/web-s/access_key.txt');
                        $FB_URL="https://graph.facebook.com/v2.9/search?q=%27restaurant%27&type=place&center={$lat},{$lon}&distance=500&locale=zh-TW&fields=location,name,overall_star_rating,rating_count,phone,link,price_range,category_list,%20hours&access_token={$access_key}&limit=5";
                        PushFBFood($userid,$FB_URL,$channelAccessToken);
                break;
                
            }
            break;
            
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
    
function unichr($i) {
    return iconv('UCS-4LE', 'UTF-8', pack('V', $i));
}
    
function ChangePoints(){
    $ex = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_change_point.php");
    $count = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_get_point.php");
    $r_message='successfully done! (left '.$count.' pts)';
    $to_me="U4a26dead451bc002afd416b24050216c";
    $to_ya="Ua24ab88b9e3bfb642ff83ef4fc1cd893";
    
    PushMessage($to_me,'兌換成功！快輸入「美食」找找要吃什麼! :)',getenv('LINE_CHANNEL_ACCESSTOKEN'));
    PushMessage($to_ya,'你成功兌換了一餐! 快輸入「美食」找找要吃什麼! :)',getenv('LINE_CHANNEL_ACCESSTOKEN'));
}
    
function PushMessage($to,$text,$channelAccessToken){
    $message_obj = [
        "to" => $to,
        "messages" => [
          [
            "type" => "text",
            "text" => $text
          ]
        ]
      ];
      $curl = curl_init() ;
      curl_setopt($curl, CURLOPT_URL, "https://api.line.me/v2/bot/message/push") ;
      curl_setopt($curl, CURLOPT_HEADER, true);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json;charset=UTF-8 ", "Authorization: Bearer " . $channelAccessToken));
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($message_obj));
      curl_exec($curl);  
      curl_close($curl);
}
    
function PushFBFood($to,$url,$channelAccessToken)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    ));

    $json = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($json, true);

    $result = array();
    foreach($data['data'] as $item){
        echo $item['name'].' - '.$item['link'].'</br>';
        $candidate = array(
            'thumbnailImageUrl' => 'https://graph.facebook.com/'.$item['id'].'/picture?type=large',
            'title' =>$item['name'],
            'text' => '★'.$item['overall_star_rating'].' 地址：'.$item['location']['street'],
            'actions' => array(
                array(
                    'type' => 'uri',
                    'label' => '查看詳情',
                    'uri' => $item['link'],
                ),
            ),
        );
        array_push($result, $candidate);
    }

    $message_obj = ["to" => $to,"messages" =>
        [
            ["type" => "template","altText" => "為您推薦下列美食：","template" => ["type" => "carousel","columns" => $result]],
            ["type" => "sticker","packageId" => '1',"stickerId" => '2']
        ]
    ];

    $curl = curl_init() ;
    curl_setopt($curl, CURLOPT_URL, "https://api.line.me/v2/bot/message/push") ;
    curl_setopt($curl, CURLOPT_HEADER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json;charset=UTF-8 ", "Authorization: Bearer " . $channelAccessToken));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($message_obj));
    curl_exec($curl);
    curl_close($curl);
}
    
function PushWeather($to,$place,$channelAccessToken){
            $search=$place;
            //PushMessage($to,$search,$channelAccessToken);
            if(strpos($search,"區") == false){
                $search.="區";
            }

            $json_city = file_get_contents('https://works.ioa.tw/weather/api/all.json');
            $data_city = json_decode($json_city, true);
            $cityID=0;
            $cityName='';

            foreach($data_city as $d){
                if (mb_strpos($search,$d['name']) !== false) {
                    //echo $d['name'].' id is : '.$d['id']."</br>";
                    $cityName=$d['name'];
                    $cityID=$d['id'];
                }
            }
    
            $json_town = file_get_contents('https://works.ioa.tw/weather/api/cates/'.$cityID.'.json');
            $data_town = json_decode($json_town, true);
            $townID=0;
            $townName='';
            foreach($data_town['towns'] as $t){
                if (mb_strpos($search,$t['name']) !== false) {
                    //echo $t['name'].' id is : '.$t['id']."</br>";
                    $townName=$t['name'];
                    $townID=$t['id'];
                }
            }

            if($cityID!=0&&$townID!=0){
                $json_weather = file_get_contents('https://works.ioa.tw/weather/api/weathers/'.$townID.'.json');
                $data_weather = json_decode($json_weather, true);

                $img_url="https://works.ioa.tw/weather/img/weathers/zeusdesign/".$data_weather['img'];
                $title=$cityName."-".$townName;
                $item1 = array(
                    'thumbnailImageUrl' => $img_url,
                    'title' => $title." ".$data_weather['desc'],
                    'text' =>"早晚溫度：".$data_weather['temperature'],
                    'actions' => array(
                        array(
                            'type' => 'uri',
                            'label' => '查看詳情',
                            'uri' => "https://works.ioa.tw/weather/towns/{$title}.html",
                        ),
                    ),
                );
                
                $item2 = array(
                    'thumbnailImageUrl' => $img_url,
                    'title' => $title." ".$data_weather['desc'],
                    'text' => "白天溫度：".(int)$data_weather['temperature']+5,
                    'actions' => array(
                        array(
                            'type' => 'uri',
                            'label' => '查看詳情',
                            'uri' => "https://works.ioa.tw/weather/towns/{$title}.html",
                        ),
                    ),
                );
                
                $response=array();
                array_push($response, $item1);
                array_push($response, $item2);

                $message_obj = ["to" => $to,"messages" =>
                    [
                        ["type" => "template","altText" => "您區域的天氣為：","template" => ["type" => "carousel","columns" => $response]],
                    ]
                ];

                $curl = curl_init() ;
                curl_setopt($curl, CURLOPT_URL, "https://api.line.me/v2/bot/message/push") ;
                curl_setopt($curl, CURLOPT_HEADER, true);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json;charset=UTF-8 ", "Authorization: Bearer " . $channelAccessToken));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($message_obj));
                curl_exec($curl);
                curl_close($curl);
            }
        }
?>
</div>
</body>
</html>

