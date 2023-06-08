<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use SergiX44\Nutgram\Nutgram;

class TelegramController extends Controller
{
    public function handle(Nutgram $bot, array $config)
    {
        $menu = new Menu($bot);
        $menu->send($config);
    }

    public function firstCalHandler(Nutgram $bot)
    {
        $bot->sendMessage('callback 1 works');
    }

    public function secondButtonHandler(Nutgram $bot)
    {
        $bot->sendMessage('callback 2 works');
    }
}
