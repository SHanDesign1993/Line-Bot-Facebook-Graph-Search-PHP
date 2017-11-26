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
                  
                	if($m_message!="")
                	{
                        $r_message="你好毛毛，祝你天天黑皮!";
                        if(strpos($m_message,"點數")!==false){
                            $count = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_get_point.php");
                            $r_message="目前毛毛的點數總共是".$count."點._.";
                        }

                        if(strpos($m_message,"結算")!==false||strpos($m_message,"加")!==false){
                            $add = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_add_point.php");
                            $count = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_get_point.php");
                            $r_message="毛毛的點數又多了一點喔！ 總共是".$count."點 >3<";
                        }

                        if(strpos($m_message,"爽歪歪")!==false){
                            $ex = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_change_point.php");
                            $count = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_get_point.php");
                            $r_message="毛毛用5點換了一餐！ 剩下".$count."點 >3<";
                        }
                  
                  
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
