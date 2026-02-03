@extends('layouts.main')

@section('title', 'メッセージ編集')

@section('content')
<h2>メッセージ編集</h2>

 <form method="POST" action="{{ route('messages.update', [$channel, $message]) }}">
    @csrf
    @method('PUT')

    <textarea name="body" rows="6" style="width:100%;">{{ old('body', $message->body) }}</textarea>
  
    @error('body')
     <p style="color:red;">{{ $message }}</p>
   @enderror

<div style="display:flex; gap:8px; margin-top:6px;">
    
<button type="submit" style="font-size:12px; background:#f0f0f0; color:#000000; padding:4px 10px; border-radius:3px;">更新</button>
 </form>
 <form method="GET" action="{{ route('channels.show', $channel) }}">
    <button type="submit" style="font-size:12px; background:#f0f0f0; color:#000000; padding:4px 10px; border-radius:3px;">戻る</button>
 </form>

</div>
@endsection
