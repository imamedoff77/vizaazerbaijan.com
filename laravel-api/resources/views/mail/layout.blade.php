<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            background: #fff;
            border: 1px solid #28b463;
        }

        .header {
            background: #28b463;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        .header a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
        }

        .content {
            padding: 10px;
        }

        .content p {
            line-height: 28px;
        }

        .font-normal {
            font-weight: normal !important;
        }

        .font-bold {
            font-weight: 600 !important;
        }

        .font-semi-bold {
            font-weight: 500 !important;
        }

        .text-warning {
            color: #f27a1a !important;
        }

        .notification-message img {
            width: 100px;
            margin-right: 10px;
            border-radius: 5px;
        }

        .notification-message .text {
            display: block;
            position: relative;
            left: 0;
            margin-top: 15px;
        }
    </style>
    @yield('custom_styles')
    <title>@yield('title', config('env.APP_NAME'))</title>
</head>
<body>
<div class="container">
    <div class="header">
        <a href="{{config('env.SITE_URL')}}">{{config('env.APP_NAME')}}</a>
    </div>
    @yield('view')
</div>
</body>
</html>
