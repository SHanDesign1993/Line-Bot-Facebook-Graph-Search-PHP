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
            switch ($message['type']) {
                case 'text':
                	$m_message = $message['text'];
                    $emoticon='...';
                    $r_message='嗨！毛毛'.$emoticon.'~\n你是來領取點數的嗎？要跟我說通關密語哦';
                        if( strpos( $message['text'], '點數' ) !== false || strpos( $message['text'], '查' ) !== false){
                            $count = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_get_point.php");
                            $bin = hex2bin(str_repeat('0', 8 - strlen('1000B6')) . '1000B6');
                            $emoticon =  mb_convert_encoding($bin, 'UTF-8', 'UTF-32BE');
                            $r_message='毛毛現在總共有 '.$count.' 點了耶耶!'.$emoticon;
                            if($count>=3){
                              $bin = hex2bin(str_repeat('0', 8 - strlen('100091')) . '100091');
                              $emoticon =  mb_convert_encoding($bin, 'UTF-8', 'UTF-32BE');
                              $r_message.='\n好誇喔喔喔'.$emoticon;
                            }else{
                              $bin = hex2bin(str_repeat('0', 8 - strlen('10008A')) . '10008A');
                              $emoticon =  mb_convert_encoding($bin, 'UTF-8', 'UTF-32BE');
                              $r_message.='\n繼續加油囉'.$emoticon;
                            }
                            
                        }

                        if( strpos( $message['text'], '漢寶我愛你' ) !== false || strpos( $message['text'], 'ok' ) !== false){
                            $add = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_add_point.php");
                            $count = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_get_point.php");
                            if($add=='ok'){
                              $bin = hex2bin(str_repeat('0', 8 - strlen('100022')) . '100022');
                              $emoticon =  mb_convert_encoding($bin, 'UTF-8', 'UTF-32BE');
                              $r_message='毛寶寶爭氣的獲得了1點&#100037\n總共有 '.$count.'點了哦嘿嘿'.$emoticon;
                            }else{
                              $bin = hex2bin(str_repeat('0', 8 - strlen('10000')) . '10000');
                              $emoticon =  mb_convert_encoding($bin, 'UTF-8', 'UTF-32BE');
                              $r_message='毛毛今天拿過點數了喔！\n'.$emoticon;
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
?>
