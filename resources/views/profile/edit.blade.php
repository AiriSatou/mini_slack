@extends('layouts.main')

@section('content')
<div style="max-width:400px; margin:0 auto;">
  <h2>プロフィール編集</h2>

  @if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
  @endif

  <form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PUT')

    <div>
      <label>表示名</label><br>
      <input type="text"
             name="display_name"
             value="{{ old('display_name', $user->display_name) }}">
    </div>

    @error('display_name')
      <p style="color:red;">{{ $message }}</p>
    @enderror

    <div style="display:flex; gap:8px; margin-top:6px;">

      <button type="submit" style="font-size:12px; background:#f0f0f0; color:#000000; padding:4px 10px; border-radius:3px;">更新</button>
   </form>

   <form method="GET" action="{{ route('dashboard') }}">
   <button type="submit" style="font-size:12px; background:#f0f0f0; color:#000000; padding:4px 10px; border-radius:3px;">戻る</button>
   </form>

   <form method="POST" action="{{ route('logout') }}">
  @csrf
  <button type="submit" style="font-size:12px; background:#696969; color:#ffffff; padding:4px 10px; border-radius:3px;">ログアウト</button>
</form>


   </div>
</div>
@endsection