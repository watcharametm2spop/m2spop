<?php

// Token
$channel_token = 'vWFV8hGQvQn/p8BCtcDjRWqmLpBaieSE46aGss4dS6pg99ovTx3aLRw8h1VOQqqJLJInHe9558Vn9XEMgUKvLnl176l4I9LVxsKoJpL/Ys9kAoRlB6rEfYcybyWNbEuU9Y/AV63nQRheUY3lBg9KcQdB04t89/1O/w1cDnyilFU=';
$channel_secret = 'c6b8cd0c86c93eb91e33ca4a18cd45f4';

// Get message from Line API
$content = file_get_contents('php://input');
$events = json_decode($content, true);

if (!is_null($events['events'])) {

	// Loop through each event
	foreach ($events['events'] as $event) {
    
        // When user click on rich menu
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {

            // Get replyToken
            $replyToken = $event['replyToken'];

            switch($event['message']['text']) {
                case 'FAQ':

                    $messages = array (
                        'type' => 'bubble',
                        'styles' =>
                            array (
                                'footer' =>
                                    array (
                                        'separator' => true,
                                    ),
                            ),
                        'body' =>
                            array (
                                'type' => 'box',
                                'layout' => 'vertical',
                                'contents' =>
                                    array (
                                        0 =>
                                            array (
                                                'type' => 'text',
                                                'text' => 'RECEIPT',
                                                'weight' => 'bold',
                                                'color' => '#1DB446',
                                                'size' => 'sm',
                                            ),
                                        1 =>
                                            array (
                                                'type' => 'text',
                                                'text' => 'Brown Store',
                                                'weight' => 'bold',
                                                'size' => 'xxl',
                                                'margin' => 'md',
                                            ),
                                        2 =>
                                            array (
                                                'type' => 'text',
                                                'text' => 'Miraina Tower, 4-1-6 Shinjuku, Tokyo',
                                                'size' => 'xs',
                                                'color' => '#aaaaaa',
                                                'wrap' => true,
                                            ),
                                        3 =>
                                            array (
                                                'type' => 'separator',
                                                'margin' => 'xxl',
                                            ),
                                        4 =>
                                            array (
                                                'type' => 'box',
                                                'layout' => 'vertical',
                                                'margin' => 'xxl',
                                                'spacing' => 'sm',
                                                'contents' =>
                                                    array (
                                                        0 =>
                                                            array (
                                                                'type' => 'box',
                                                                'layout' => 'horizontal',
                                                                'contents' =>
                                                                    array (
                                                                        0 =>
                                                                            array (
                                                                                'type' => 'text',
                                                                                'text' => 'Energy Drink',
                                                                                'size' => 'sm',
                                                                                'color' => '#555555',
                                                                                'flex' => 0,
                                                                            ),
                                                                        1 =>
                                                                            array (
                                                                                'type' => 'text',
                                                                                'text' => '$2.99',
                                                                                'size' => 'sm',
                                                                                'color' => '#111111',
                                                                                'align' => 'end',
                                                                            ),
                                                                    ),
                                                            ),
                                                        1 =>
                                                            array (
                                                                'type' => 'box',
                                                                'layout' => 'horizontal',
                                                                'contents' =>
                                                                    array (
                                                                        0 =>
                                                                            array (
                                                                                'type' => 'text',
                                                                                'text' => 'Chewing Gum',
                                                                                'size' => 'sm',
                                                                                'color' => '#555555',
                                                                                'flex' => 0,
                                                                            ),
                                                                        1 =>
                                                                            array (
                                                                                'type' => 'text',
                                                                                'text' => '$0.99',
                                                                                'size' => 'sm',
                                                                                'color' => '#111111',
                                                                                'align' => 'end',
                                                                            ),
                                                                    ),
                                                            ),
                                                        2 =>
                                                            array (
                                                                'type' => 'box',
                                                                'layout' => 'horizontal',
                                                                'contents' =>
                                                                    array (
                                                                        0 =>
                                                                            array (
                                                                                'type' => 'text',
                                                                                'text' => 'Bottled Water',
                                                                                'size' => 'sm',
                                                                                'color' => '#555555',
                                                                                'flex' => 0,
                                                                            ),
                                                                        1 =>
                                                                            array (
                                                                                'type' => 'text',
                                                                                'text' => '$3.33',
                                                                                'size' => 'sm',
                                                                                'color' => '#111111',
                                                                                'align' => 'end',
                                                                            ),
                                                                    ),
                                                            ),
                                                        3 =>
                                                            array (
                                                                'type' => 'separator',
                                                                'margin' => 'xxl',
                                                            ),
                                                        4 =>
                                                            array (
                                                                'type' => 'box',
                                                                'layout' => 'horizontal',
                                                                'margin' => 'xxl',
                                                                'contents' =>
                                                                    array (
                                                                        0 =>
                                                                            array (
                                                                                'type' => 'text',
                                                                                'text' => 'ITEMS',
                                                                                'size' => 'sm',
                                                                                'color' => '#555555',
                                                                            ),
                                                                        1 =>
                                                                            array (
                                                                                'type' => 'text',
                                                                                'text' => '3',
                                                                                'size' => 'sm',
                                                                                'color' => '#111111',
                                                                                'align' => 'end',
                                                                            ),
                                                                    ),
                                                            ),
                                                        5 =>
                                                            array (
                                                                'type' => 'box',
                                                                'layout' => 'horizontal',
                                                                'contents' =>
                                                                    array (
                                                                        0 =>
                                                                            array (
                                                                                'type' => 'text',
                                                                                'text' => 'TOTAL',
                                                                                'size' => 'sm',
                                                                                'color' => '#555555',
                                                                            ),
                                                                        1 =>
                                                                            array (
                                                                                'type' => 'text',
                                                                                'text' => '$7.31',
                                                                                'size' => 'sm',
                                                                                'color' => '#111111',
                                                                                'align' => 'end',
                                                                            ),
                                                                    ),
                                                            ),
                                                        6 =>
                                                            array (
                                                                'type' => 'box',
                                                                'layout' => 'horizontal',
                                                                'contents' =>
                                                                    array (
                                                                        0 =>
                                                                            array (
                                                                                'type' => 'text',
                                                                                'text' => 'CASH',
                                                                                'size' => 'sm',
                                                                                'color' => '#555555',
                                                                            ),
                                                                        1 =>
                                                                            array (
                                                                                'type' => 'text',
                                                                                'text' => '$8.0',
                                                                                'size' => 'sm',
                                                                                'color' => '#111111',
                                                                                'align' => 'end',
                                                                            ),
                                                                    ),
                                                            ),
                                                        7 =>
                                                            array (
                                                                'type' => 'box',
                                                                'layout' => 'horizontal',
                                                                'contents' =>
                                                                    array (
                                                                        0 =>
                                                                            array (
                                                                                'type' => 'text',
                                                                                'text' => 'CHANGE',
                                                                                'size' => 'sm',
                                                                                'color' => '#555555',
                                                                            ),
                                                                        1 =>
                                                                            array (
                                                                                'type' => 'text',
                                                                                'text' => '$0.69',
                                                                                'size' => 'sm',
                                                                                'color' => '#111111',
                                                                                'align' => 'end',
                                                                            ),
                                                                    ),
                                                            ),
                                                    ),
                                            ),
                                        5 =>
                                            array (
                                                'type' => 'separator',
                                                'margin' => 'xxl',
                                            ),
                                        6 =>
                                            array (
                                                'type' => 'box',
                                                'layout' => 'horizontal',
                                                'margin' => 'md',
                                                'contents' =>
                                                    array (
                                                        0 =>
                                                            array (
                                                                'type' => 'text',
                                                                'text' => 'PAYMENT ID',
                                                                'size' => 'xs',
                                                                'color' => '#aaaaaa',
                                                                'flex' => 0,
                                                            ),
                                                        1 =>
                                                            array (
                                                                'type' => 'text',
                                                                'text' => '#743289384279',
                                                                'color' => '#aaaaaa',
                                                                'size' => 'xs',
                                                                'align' => 'end',
                                                            ),
                                                    ),
                                            ),
                                    ),
                            ),
                    ) ;

                    // Create message for send to LINE Server
                    $message = array(
                        'replyToken' => $replyToken,
                        'messages' => array(
                            'type' => 'flex',
                            'contents' => $messages,
                        )
                    );

                    error_log(json_encode($message));

                    send_message_to_line($channel_token, $message);

                    break;
            }
		}
	}
}

/**
 * Call curl to send message to LINE
 *
 * @param string $access_token
 * @param array $message
 */
function send_message_to_line($access_token, $message){
    $url = 'https://api.line.me/v2/bot/message/reply';

    $headers = array();
    $headers[] = "Content-Type: application/json";
    $headers[] = "Authorization: Bearer {$access_token}";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);

    error_log($result);

    curl_close($ch);
}

echo "OK";
