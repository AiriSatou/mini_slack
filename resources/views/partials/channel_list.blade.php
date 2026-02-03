<div style="margin-bottom:10px; text-align:left;">
  <a href="{{ route('profile.edit') }}"style="display:inline-block; font-size:12px; padding:6px 10px; background:#dcdcdc; color:#000; border-radius:6px; text-decoration:none;">
    プロフィール編集
  </a>
</div>

<h3 style="font-size:13px; color:#fff; margin-bottom:8px;">
  チャンネル
</h3>

<ul style="list-style:none; padding:0; margin:0 0 16px;">
 @forelse($channels as $c)
    <li style="margin:6px 0;
               padding:4px 6px;
              {{ isset($channel) && $channel->id === $c->id ? 'font-weight:bold; background:#1164A3; border-radius:4px;': '' }}">
        <a href="{{ route('channels.show', $c) }}"
           style="text-decoration:none; color:inherit;">
            # {{ $c->name }}
        </a>
    </li>
@empty
    <li>チャンネルがありません</li>
  @endforelse
</ul>

<form method="POST" action="{{ route('channels.store') }}">
  @csrf
  <input type="text" name="name" placeholder="チャンネル名" value="{{ old('name') }}" style="width:100%; margin-bottom:8px; color:#000000;">
  <div style="text-align:right;">
  <button type="submit" style="font-size:12px; width:20%; background:#dcdcdc; color:#000000; border:none; padding:4px 0; border-radius:5px;">作成</button>
</form>

@error('name')
  <p style="color:red; margin-top:8px;">{{ $message }}</p>
@enderror
