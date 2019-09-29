<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{

    public function getUpdates()
    {
        $updates = Telegram::getUpdates();
        dd($updates);
    }

    public function sendMessage()
    {
        Telegram::sendMessage([
            'chat_id' => -1001157086105.0,
            'parse_mode' => 'HTML',
            'text' => 'tes'
        ]);

    }
}