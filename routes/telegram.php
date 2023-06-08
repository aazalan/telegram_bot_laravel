<?php

use App\Http\Controllers\TelegramController;
use SergiX44\Nutgram\Nutgram;


$bot = new Nutgram($_ENV['TELEGRAM_TOKEN']);

$bot->onCommand('start', function(Nutgram $bot){
    $config = [
        'row_1' => [
            'Button 1' => [
                'type' => 'call',
                'handler' => 'btn1'
            ], 
            'Button 2' => [
                'type' => 'url',
                'handler' => 'https://nutgram.dev'
            ]
        ],
        'row_2' => [
            'Button 3' => [
                'type' => 'url',
                'handler' => 'https://www.youtube.com/'
            ], 
            'Button 4' => [
                'type' => 'call',
                'handler' => 'btn2'
            ]
            ]
    ];
    $telegram = new TelegramController();
    $telegram->handle($bot,$config);
});

$bot->onCallbackQueryData('btn1', function(Nutgram $bot){
    $telegram = new TelegramController();
    $telegram->firstCalHandler($bot);
});

$bot->onCallbackQueryData('btn2', function(Nutgram $bot){
    $telegram = new TelegramController();
    $telegram->secondButtonHandler($bot);
});

$bot->run();