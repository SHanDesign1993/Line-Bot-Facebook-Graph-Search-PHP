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
                  $r_message="�A�n���A���A�ѤѶ¥�!";
                	if($m_message!="")
                	{
                    if(strpos($m_message,"�I��")){
                            $pt = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_get_point.php");
                            $r_message="�ثe����I���`�@�O".$pt."�I._.";
                        }

                        if(strpos($m_message,"����")||strpos($m_message,"�[")){
                            $add = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_add_point.php");
    
                            $pt = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_get_point.php");
                            $r_message="����I�ƤS�h�F�@�I��I �`�@�O".$pt."�I >3<";
                        }

                        if(strpos($m_message,"�n�n�n")){
                            $ex = file_get_contents("http://140.117.6.187/Analysis/FunctionDisplay/linebot_change_point.php");
                            $r_message="����I�ƤS�h�F�@�I��I �`�@�O".$pt."�I >3<";
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
