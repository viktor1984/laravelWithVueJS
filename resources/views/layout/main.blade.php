<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="/css/app.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <title>Laravel App</title>
</head>
<body>

    <div id="my-app">
        @include('layout.header')

        <section class="section">
            <div class="container">
                <router-view></router-view>
            </div>
        </section>
    </div>

    <script src="/js/app.js"></script>
</body>
</html>
