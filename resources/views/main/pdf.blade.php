<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>

    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body{
            font-family: mitra, sans-serif,arial;
        }


        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;

        }
        td{
            font-size: 12px;
        }
        tr:nth-child(even) {
            background-color: #dddddd;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
        }

    </style>
  <script type="text/javascript" src="/home/js/jquery-2.2.0.min.js"></script>
</head>

<body >
    @yield('content')
</body>
</html>



