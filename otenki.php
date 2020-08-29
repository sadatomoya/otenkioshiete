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

$channelAccessToken = 'IZypbEjxNr9j1YEnjJjoDR+Sou06FntdLiu5RayWB+1frGn2pdM5PlzQ09vL4nnX7zqLdLDhMM/3MRoHPJvx/88zvZWilfLgByL2tNM72L3+ORFEWZzo/Ht3IHvM2BLiMHajF9kntYOuEyErpKAaDQdB04t89/1O/w1cDnyilFU=';
$channelSecret = '6854c7c4eceade9bea43850274a87fac';

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) { switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
					if (strpos($message['text'], '天気') !== false) {
						$rep = 'http://weather.yahoo.co.jp/weather/';
					}
                    $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                           array(
                                'type' => 'text',
                                'text' => $rep
							)
						)
					));
                    break;
                default:
                    error_log('Unsupported message type: ' . $message['type']);
                    break;
            }
            break;
        default:
            error_log('Unsupported event type: ' . $event['type']);
            break;
    }
};
?>
