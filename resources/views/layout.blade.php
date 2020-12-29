<!DOCTYPE html>
<html>
<head>
    <title>product</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>    
<body>
    @yield('content')
  <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>