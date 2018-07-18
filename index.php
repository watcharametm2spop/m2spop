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
                        'body' =>
                            array (
                                'type' => 'box',
                                'layout' => 'vertical',
                                'spacing' => 'md',
                                'contents' =>
                                    array (
                                        0 =>
                                            array (
                                                'type' => 'box',
                                                'layout' => 'vertical',
                                                'margin' => 'sm',
                                                'contents' =>
                                                    array (
                                                        0 =>
                                                            array (
                                                                'type' => 'text',
                                                                'text' => 'I AM HAVING PROBLEMS ACCESSING SAMPLE STORE. SOME OF THE PAGES LOOK WEIRD. AM I USING THE RIGHT BROWSER?',
                                                                'wrap' => true,
                                                                'color' => '#000000',
                                                            ),
                                                        1 =>
                                                            array (
                                                                'type' => 'text',
                                                                'text' => 'As Sample Store uses some of the latest graphics designs which may not be supported in lower version of browsers, it is recommended that you use the following browsers to access Sample Store: 

 1. Microsoft Internet Explorer Version 10 onwards.',
                                                                'wrap' => true,
                                                                'color' => '#666666',
                                                            ),
                                                    ),
                                            ),
                                        1 =>
                                            array (
                                                'type' => 'separator',
                                            ),
                                        2 =>
                                            array (
                                                'type' => 'box',
                                                'layout' => 'vertical',
                                                'margin' => 'sm',
                                                'contents' =>
                                                    array (
                                                        0 =>
                                                            array (
                                                                'type' => 'text',
                                                                'text' => 'HOW DO I MAKE PAYMENTS USING PAYPAL? HOW DOES IT WORK? ',
                                                                'wrap' => true,
                                                                'color' => '#000000',
                                                            ),
                                                        1 =>
                                                            array (
                                                                'type' => 'text',
                                                                'text' => 'Paypal is the easiest way to make payments online. While checking out your order, you will be redirected to the Paypal website. Be sure to fill in correct details for fast & hassle-free payment processing. After a successful Paypal payment, a payment advice will be automatically generated to Samplestore.com system for your order.',
                                                                'wrap' => true,
                                                                'color' => '#666666',
                                                            ),
                                                    ),
                                            ),
                                    ),
                            ),
                    );

                    // Create message for send to LINE Server
                    $message = array(
                        'replyToken' => $replyToken,
                        'messages' => array(
                            array(
                                'type' => 'flex',
                                'altText' => 'FAQ',
                                'contents' => $messages,
                            )
                        ));

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
