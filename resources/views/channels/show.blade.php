{{--チャンネル詳細画面--}}

@extends('layouts.main')

@section('title', '#'.$channel->name)

@section('sidebar')
  @include('partials.channel_list', ['channels' => $channels, 'channel' => $channel])
@endsection

@section('content')
  <h2 style="font-size:20px; font-weight:700; margin-top:0;" >{{ $channel->name }}</h2>

  @if(auth()->id() === $channel->created_by)
  <form method="POST" action="{{ route('channels.destroy', $channel) }}"
        onsubmit="return confirm('このチャンネルを削除しますか？');">
    @csrf
    @method('DELETE')
    <button type="submit" style="font-size:12px; background:#f0f0f0; color:#000000; padding:3px 6px; border-radius:3px;">チャンネル削除</button>
  </form>
@endif

  <ul style="list-style:none; padding:0;">

    @forelse($messages as $message)
    
      <li style="padding:10px 0; border-bottom:1px solid #f2f2f2;">
        <div>
          <strong class="message-user">{{ $message->user->display_name ?? $message->user->name }}</strong>

          <span style="color:#666; font-size:12px;">
            {{ $message->created_at->format('m/d H:i') }}
          </span>
        </div>

        <div>{!! nl2br(e($message->body)) !!}</div>

        @if(auth()->id() === $message->user_id)
                <div style="display:flex; gap:8px; margin-top:6px;">
                  <form method="GET" action="{{ route('messages.edit', [$channel, $message]) }}">
                       <button type="submit" style="font-size:12px; background:#f0f0f0; color:#000000; padding:3px 6px; border-radius:3px;">編集</button>
                  </form>

                  <form method="POST" action="{{ route('messages.destroy', [$channel, $message]) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                       <button type="submit" style="font-size:12px; background:#f0f0f0; color:#000000; padding:3px 6px; border-radius:3px;">削除</button>
                  </form>
                </div>
        @endif
      </li>
    @empty
      <li>メッセージはまだありません</li>
    @endforelse
  </ul>

  <form method="POST" action="{{ route('messages.store', $channel) }}">
    @csrf
    <textarea name="body" rows="4" style="width:50%;">{{ old('body') }}</textarea>
    @error('body')
      <p style="color:red;">{{ $message }}</p>
    @enderror
    <div style="text-align:center;">
    <button type="submit" style="font-size:12px; background:#f0f0f0; color:#000000; padding:3px 6px; border-radius:3px;">投稿</button>
  </form>
@endsection