<?php
/*
 {
  "events": [
      {
        "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA",
        "type": "message",
        "timestamp": 1462629479859,
        "source": {
             "type": "user",
             "userId": "U206d25c2ea6bd87c17655609a1c37cb8"
         },
         "message": {
             "id": "325708",
             "type": "text",
             "text": "Hello, world"
          }
      }
  ]
}
 */

require_once('./vendor/autoload.php');

// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

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
                
                case 'Open shop':
                    $columns = array();

                    $img_url = "https://gloimg.rglcdn.com/rosegal/pdm-product-pic/Clothing/2017/12/28/source-img/20171228165936_78536.jpg";

                    for($i=0;$i<2;$i++) {
                        $actions = array(
                            new \LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder("สั่งซื้อเสื้อเบอร์ S","https://m2spop.herokuapp.com/buy.php?id=10&size=S"),
                            new \LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder("สั่งซื้อเสื้อเบอร์ M","https://m2spop.herokuapp.com/buy.php?id=10&size=M"),
                            new \LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder("สั่งซื้อเสื้อเบอร์ L","https://m2spop.herokuapp.com/buy.php?id=10&size=L"),
                        );

                        $column = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder("Hoodie", "Pellentesque habitant morbi tristique senectus et netus et m", $img_url , $actions);
                        $columns[] = $column;
                    }

                    $carousel = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder($columns);
                    $templateMessageBuilder = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder("Carousel Demo", $carousel);

                    
                    $httpClient = new CurlHTTPClient($channel_token);
                    $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
                    $response = $bot->replyMessage($replyToken, $templateMessageBuilder);

                    break;
            }
		}
	}
}

echo "OK";
