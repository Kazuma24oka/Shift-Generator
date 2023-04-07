<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- FullCalendar dependencies -->
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('js/locale-all.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}">
</head>
<body>

<div class="container">
    @yield('content')
</div>

</body>
</html>