<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;
use App\Models\Message;

class MessageController extends Controller
{
    public function store(Request $request ,Channel $channel){
        $validated = $request->validate([
            'body' => 'required|string|max:1000'
        ]);//バリデーション　本文は必須、最大1000文字

        Message::create([
            'channel_id' => $channel->id,
            'user_id'=> auth()->id(),
            'body'=> $validated['body'] 
         ]);//メッセージを作成→チャンネルID、ユーザー名、本文を保存

        return redirect()->route('channels.show',$channel)->with('success','投稿しました');
        //リダイレクトでチャンネル詳細へ。成功したらフラッシュメッセージを表示
    }

    public function destroy(Channel $channel,Message $message){
        if($message->channel_id !== $channel->id) abort(404);
        //そのメッセージがそのチャンネルのものか確認　違う場合は404エラー
        if($message->user_id !== auth()->id()) abort(403);
        //そのメッセージが自分のものかどうか確認　違う場合は403エラー
        $message->delete();
        //メッセージ削除

        return redirect()->route('channels.show',$channel)->with('success','削除しました');
        //リダイレクトでチャンネル詳細へ。成功したらフラッシュメッセージを表示
    }

    public function edit(Channel $channel, Message $message){
       if ($message->channel_id !== $channel->id) abort(404); //メッセージがそのチャンネルのものか確認
       if (auth()->id() !== $message->user_id) abort(403); //メッセージが自分のものか確認

       return view('messages.edit', compact('channel', 'message')); //編集画面を表示
    }

public function update(Request $request, Channel $channel, Message $message){
       if ($message->channel_id !== $channel->id) abort(404); //メッセージがそのチャンネルのものか確認
       if (auth()->id() !== $message->user_id) abort(403); //メッセージは自分のものか確認

       $validated = $request->validate(['body' => 'required|string|max:1000', 
    ]);

       $message->update(['body' => $validated['body']]); //メッセージ更新

       return redirect()->route('channels.show', $channel)->with('success', '更新しました');
       //リダイレクトでチャンネル詳細へ。成功したらフラッシュメッセージを表示
    }

}

