<?php

// Get message from Line API
$content = file_get_contents('php://input');
$events = json_decode($content, true);

if (!is_null($events['events'])) {

    require_once('./LINEBotTiny.php');

    // Token
    $channel_token = 'vWFV8hGQvQn/p8BCtcDjRWqmLpBaieSE46aGss4dS6pg99ovTx3aLRw8h1VOQqqJLJInHe9558Vn9XEMgUKvLnl176l4I9LVxsKoJpL/Ys9kAoRlB6rEfYcybyWNbEuU9Y/AV63nQRheUY3lBg9KcQdB04t89/1O/w1cDnyilFU=';
    $channel_secret = 'c6b8cd0c86c93eb91e33ca4a18cd45f4';

    $client = new LINEBotTiny($channel_token, $channel_secret);

    // Loop through each event
	foreach ($events['events'] as $event) {
    
        // When user click on rich menu
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {

            // Get replyToken
            $replyToken = $event['replyToken'];

            switch($event['message']['text']) {
                case 'FAQ':
                    $messages = array();
                    #Message 1
                    $messages[] = array(
                        'type' => 'box',
                        'layout' => 'vertical',
                        'spacing' => 'sm',
                        'contents' => array(
                            array(
                                'type' => 'text',
                                'text' => 'I AM HAVING PROBLEMS ACCESSING SAMPLE STORE. SOME OF THE PAGES LOOK WEIRD. AM I USING THE RIGHT BROWSER?',
                                'wrap' => true,
                                'color' => '#000000',
                            ),
                            array(
                                'type' => 'text',
                                'text' => 'As Sample Store uses some of the latest graphics designs which may not be supported in lower version of browsers, it is recommended that you use the following browsers to access Sample Store: \n\r 1. Microsoft Internet Explorer Version 10 onwards.',
                                'wrap' => true,
                                'color' => '#000000',
                            ),
                        )
                    );


                    error_log(json_encode($messages));

                    // Send message to Customer through LINE
                    $client->replyMessage(array(
                        'replyToken' => $replyToken,
                        'messages' => array(
                            'type' => 'bubble',
                            'body' => array(
                                'type' => 'box',
                                'layout' => 'vertical',
                                'spacing' => 'md',
                                'contents' => $messages,
                            )
                        )
                    ));

                    break;
            }
		}
	}
}


echo "OK";
