<?php

namespace Modules\Chatbot\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use BotMan\BotMan\BotMan;
use Modules\Chatbot\App\Conversations\MedicalServiceConversation;

class BotManController extends Controller
{
    public function handle(Request $request)
    {
        $botman = app('botman');

        $botman->hears('.*', function(BotMan $bot) {
            $bot->startConversation(new MedicalServiceConversation());
        });

        $botman->listen();
    }
} 