<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- favicon -->
	    <link rel="shortcut icon" href="../images/favicon.ico">
        <title>宮崎市民活動センター</title>
        <link type="text/css" rel="stylesheet" href="{{ elixir('/css/app.css') }}" />

        <script>
            window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};
        </script>
    </head>
    <body>
        <div id="app">
        </div>
        <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
        <script src="{{ elixir('/js/app.js') }}"></script>
    </body>
</html>
