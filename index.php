<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/LINEBotTiny.php';

use Automattic\WooCommerce\Client as WooCommerceClient;

// LINE Client
$channel_token = 'vWFV8hGQvQn/p8BCtcDjRWqmLpBaieSE46aGss4dS6pg99ovTx3aLRw8h1VOQqqJLJInHe9558Vn9XEMgUKvLnl176l4I9LVxsKoJpL/Ys9kAoRlB6rEfYcybyWNbEuU9Y/AV63nQRheUY3lBg9KcQdB04t89/1O/w1cDnyilFU=';
$channel_secret = 'c6b8cd0c86c93eb91e33ca4a18cd45f4';
$LINEClient = new LINEBotTiny($channel_token, $channel_secret);

// WooCommerce Client
$wooEnpoint = 'http://m2spop.kinsta.com';
$wooConsumerKey = 'ck_baefb163a9eaf1be2344dd858f45eb79c470e60e';
$wooConsumerSecret = 'cs_8210144df1f6f4dac609e31c6a9c64e1cecb1bfa';
$woocommerce = new WooCommerceClient(
    $wooEnpoint,
    $wooConsumerKey,
    $wooConsumerSecret,
    [
        'wp_api' => true,
        'version' => 'wc/v1',
    ]
);

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

            switch ($event['message']['text']) {

                case 'FAQ':

                    $messages = array(
                        'type' => 'bubble',
                        'body' =>
                            array(
                                'type' => 'box',
                                'layout' => 'vertical',
                                'spacing' => 'md',
                                'contents' =>
                                    array(
                                        array(
                                            'type' => 'box',
                                            'layout' => 'vertical',
                                            'margin' => 'sm',
                                            'contents' =>
                                                array(
                                                    array(
                                                        'type' => 'text',
                                                        'text' => 'I AM HAVING PROBLEMS ACCESSING SAMPLE STORE. SOME OF THE PAGES LOOK WEIRD. AM I USING THE RIGHT BROWSER?',
                                                        'wrap' => true,
                                                        'color' => '#000000',
                                                    ),
                                                    array(
                                                        'type' => 'text',
                                                        'text' => 'As Sample Store uses some of the latest graphics designs which may not be supported in lower version of browsers, it is recommended that you use the following browsers to access Sample Store: 

 1. Microsoft Internet Explorer Version 10 onwards.',
                                                        'wrap' => true,
                                                        'color' => '#666666',
                                                    ),
                                                ),
                                        ),
                                        array(
                                            'type' => 'separator',
                                        ),
                                        array(
                                            'type' => 'box',
                                            'layout' => 'vertical',
                                            'margin' => 'sm',
                                            'contents' =>
                                                array(
                                                    array(
                                                        'type' => 'text',
                                                        'text' => 'HOW DO I MAKE PAYMENTS USING PAYPAL? HOW DOES IT WORK? ',
                                                        'wrap' => true,
                                                        'color' => '#000000',
                                                    ),
                                                    array(
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
                    $LINEClient->replyMessage(array(
                        'replyToken' => $replyToken,
                        'messages' => array(
                            array(
                                'type' => 'flex',
                                'altText' => 'FAQ',
                                'contents' => $messages,
                            )
                        )));

                    break;

                case 'New Avairal':
                    $products = $woocommerce->get('products', array( 'orderby' => 'date', 'order' => 'desc', 'per_page' => 10));

                    // Create carousel for New Avairal products
                    $LINEClient->replyMessage(array(
                        'replyToken' => $replyToken,
                        'messages' => array(
                            array(
                                'type' => 'template',
                                'altText' => 'this is a carousel template',
                                'template' => array(
                                    'type' => 'carousel',
                                    'actions' => array(),
                                    'columns' => array(
                                        array(
                                            'thumbnailImageUrl' => 'http://m2spop.local/wp-content/uploads/2018/07/t-shirt-with-logo-1.jpg',
                                            'title' => 'Hoodie', 'text' => 'Pellentesque habitant morbi tristique senectus et netus et m',
                                            'actions' => array(
                                                array(
                                                    'type' => 'postback',
                                                    'label' => 'สั่งซื้อไซต์ S',
                                                    'text' => 'สั่งซื้อ',
                                                    'data' => '{action:\'order\', id: 1, size: \'S\'}',
                                                ),
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        )));

                    break;

                case 'Best Seller':
                    $orders = $woocommerce->get('orders');
                    error_log(json_encode($orders));
                    break;
            }
        }
    }
}


echo "OK";
