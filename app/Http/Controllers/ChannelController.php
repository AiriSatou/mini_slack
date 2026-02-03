<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;
use App\Models\Message;

class ChannelController extends Controller
{
    public function index(){
        $channels = Channel::orderBy('created_at','desc')->get(); //作成日の降順で取得
        return view('channels.index',compact('channels'));
        }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:30|unique:channels'
        ]); //バリデーション　名前は必須、最大30文字、チャンネル名は重複NG

        $channel =Channel::create([
            'name' => $validated['name'],
            'created_by' => auth()->id()
        ]); //チャンネル作成者のIDを保存

        return redirect()->route('channels.show',$channel)->with('success','作成しました');
        //リダイレクトで一覧へ。成功したらフラッシュメッセージを表示
        }

        public function show(Channel $channel){
         auth()->user()->update(['last_channel_id' => $channel->id,]); 
         $channels = Channel::orderBy('created_at','desc')->get(); //サイドバー用に全チャンネル取得
         $messages = Message::where('channel_id',$channel->id)
                     ->with('user')
                     ->orderBy('created_at','asc')
                     ->get(); //チャンネルに紐づくメッセージを取得（昇順で表示）
        return view('channels.show', compact('channel','channels','messages')); 
        }

        public function destroy(Channel $channel)
{
    if (auth()->id() !== $channel->created_by) abort(403);

    $deletedId = $channel->id;
    $channel->delete();

    // もし削除したのが「最後に見たチャンネル」ならリセット
    $user = auth()->user();
    if ($user->last_channel_id === $deletedId) {
        $user->last_channel_id = null;
        $user->save();
    }

    // 次に表示するチャンネル（例：一番新しいチャンネル）
    $nextChannel = Channel::orderBy('id', 'desc')->first();

    if ($nextChannel) {
        return redirect()
            ->route('channels.show', $nextChannel)
            ->with('success', '削除しました');
    }

    // チャンネルが0件なら一覧へ
    return redirect()->route('channels.index')->with('success', '削除しました');
}
}
