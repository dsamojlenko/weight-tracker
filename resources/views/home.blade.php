<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">

        <title>Weight-Tracker</title>

        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div id="app">
            @include('notifications')

            <div class="flex-none sm:flex h-screen">
                @include('user_panel', [
                    'user' => $user2
                ])

                @include('chart_panel', [
                    'data' => $data,
                    'labels' => $labels
                ])

                @include('user_panel', [
                    'user' => $user1
                ])
            </div>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>

        <script type="text/javascript">
            /**
             * When user taps the screen, animate out the alert
             */
            const overlay = $('.error-overlay');
            const modal = $('.error-modal');

            overlay.on('click', function () {
                $('.alert-message').animate({
                    top: '-200px'
                }, 300, function() {
                    overlay.fadeOut()
                    modal.fadeOut()
                });
            });

            /**
             * If there is an alert message, animate it in
             */
            $('.alert-message').animate({
                top: '50px'
            }, 300, function() {
                console.log("Huzzah");
            })
        </script>
    </body>
</html>
