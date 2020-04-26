<head>
  <title>{{ $title ?? 'Password Manager'}}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ url('css/normalize.css') }}">
  <link rel="stylesheet" href="{{ url('css/app.css') }}">
  <!-- https://stackoverflow.com/questions/35877994/font-awesome-is-loading-very-slow/35880730 -->
  <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = 'https://use.fontawesome.com/releases/v5.1.0/css/all.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
  <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
</head>
