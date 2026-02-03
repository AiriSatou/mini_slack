{{-- チャンネル一覧表示 --}}

<ul>
    @forelse($channels as $channel)
    <li>
        <a href="{{ route('channels.show',$channel) }}">
        #{{ $channel->name }}
        </a>
    </li>
    @empty
    <li>データは１件もありません</li>
    @endforelse
</ul>

{{-- 新規チャンネル作成 --}}
<form method="POST" action="{{( route('channels.store')) }}">
    @csrf
     <input type="text" 
     name="name" 
     placeholder="チャンネル名" 
     value="{{ old('name') }}">

     <button type="submit">作成</button>
</form>