<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardMarkup;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;

class Menu extends Model
{
    use HasFactory;

    private $bot;

    public function __construct(Nutgram $bot)
    {
        $this->bot = $bot;
    }

    public function send($config)
    {
        $markup = InlineKeyboardMarkup::make();
        foreach ($config as $row) {
            $buttons = [];
            foreach ($row as $buttonName => $data) {
                if ($data['type'] === 'call') {
                    $buttons[] = InlineKeyboardButton::make($buttonName, callback_data: $data['handler']);
                }
                if ($data['type'] === 'url') {
                    $buttons[] = InlineKeyboardButton::make($buttonName, $data['handler']);
                }
            }
            $markup->addRow(...$buttons);
        }

        $this->bot->sendMessage(
            text: 'menu',
            reply_markup: $markup
        );
    }
}
