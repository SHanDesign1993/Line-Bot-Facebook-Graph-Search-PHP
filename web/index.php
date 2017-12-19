<?php

/**
 * Copyright 2016 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require_once('./LINEBotTiny.php');



$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            $userid =  $event['source']['userId'];
            switch ($message['type']) {
                case 'text':
                	$m_message = $message['text'];
                    $r_message='嗨！毛毛'.unichr(0x100037).'~你是來領取點數的嗎？要跟我說通關密語哦'; 
                    
                        if(strpos( $message['text'], 'who' ) !== false){
                            $r_message = print_r($event['source'],true);

                        }
                        if( strpos( $message['text'], '點數' ) !== false || strpos( $message['text'], '查' ) !== false){
                            $count = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_get_point.php");
                            $r_message='毛毛現在總共有 '.$count.' 點!!!'.unichr(0x1000B6);
                            if($count>=3){
                              $r_message.=' 好誇喔喔喔'.unichr(0x100091);
                            }else if($count==0){
                              $r_message.=' 恩...多笑一點吧！'.unichr(0x10008E);
                            }else{
                              $r_message.=' 繼續加油囉'.unichr(0x10008A);
                            }
                            
                        }

                        if( strpos( $message['text'], '漢寶我愛你' ) !== false || strpos( $message['text'], 'ok' ) !== false){
                            $add = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_add_point.php");
                            $count = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_get_point.php");
                            if($add=='ok'){
                              $r_message='毛寶寶爭氣的獲得了1點~總共有 '.$count.'點了哦嘿嘿'.unichr(0x100022);
                            }else{
                              $r_message='毛毛今天拿過點數了喔！這樣不乖內'.unichr(0x10000E);
                            }
                        }

                        if(strpos( $message['text'], '毛毛吃大餐' ) !== false){
                            $ex = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_change_point.php");
                            $count = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_get_point.php");
                            $r_message='兌換成功！';
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
?>
