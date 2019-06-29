<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ChatController extends baseController
{
    
    public function sendMessage()
    {
        $username = Input::get('username');
        $text = Input::get('text');

       //$chatMessage = new \ChatMessage();

        DB::table('chat_messages')->insert(['sender_username'=>$username,'message'=>$text]);
        //$chatMessage->sender_username = $username;
       // $chatMessage->message = $text;
        //$chatMessage->save();
        
    
    
    }

    public function isTyping()
    {
        $username = Input::get('username');

        $chat = DB::table('chats')->where('id',1)->get();
        if ($chat->user1 == $username)
        {    
            DB::table('chats')->where()->update(['user1_is_typing'=>true]);
            //$chat->user1_is_typing = true;
        }
            else{
                DB::table('chats')->where()->update(['user2_is_typing'=>true]);    
            //$bo $chat->user2_is_typing = true;
            }
    }

    public function notTyping()
    {
        $username = Input::get('username');

        $chat = DB::table('chats')->where('id',1)->get();
        if ($chat->user1 == $username)
            $chat->user1_is_typing = false;
        else
            $chat->user2_is_typing = false;
        $chat->save();
    }

    public function retrieveChatMessages()
    {
        $username = Input::get('username');

        $message = DB::table('chat_messages')->where('sender_username', '!=', $username)->where('read', '=', false)->first();

        if (count($message) > 0)
        {
            $message->read = true;
            $message->save();
            return $message->message;
        }
    }

    public function retrieveTypingStatus()
    {


        
        $username = Input::get('username');

        $chat = DB::table('chats')->where('id',1)->get();
        if ($chat->user1 == $username)
        {
            if ($chat->user2_is_typing)
                return $chat->user2;
        }
        else
        {
            if ($chat->user1_is_typing)
                return $chat->user1;
        }
    }

}
