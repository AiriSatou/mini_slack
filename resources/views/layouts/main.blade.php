<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'mini_slack')</title>

  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <script src="{{ mix('js/app.js') }}" defer></script>

</head>

<body>
  <div style="display:flex; min-height:100vh;">

    <aside style="width:260px; background:#3F0E40; color:#fff; padding:16px;">
      @yield('sidebar')
    </aside> 

    <main style="flex:1; padding:16px; border-left:1px solid #ddd;">
    @yield('content')
    </main>
  </div>
</body>
</html>