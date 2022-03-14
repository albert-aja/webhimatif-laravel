<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta http-equiv="Content-Type" content="text/html">
        <meta charset="UTF-8"/>
        <style>
            body {
                background-color: #f6f6f6;
                font-family: sans-serif;
                -webkit-font-smoothing: antialiased;
                font-size: 14px;
                line-height: 1.4;
                margin: 2em 0;
                padding: 0;
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
            }

            .pad-0 {
                padding: 0;
            }

            .preheader {
                color: transparent;
                display: none;
                height: 0;
                max-height: 0;
                max-width: 0;
                opacity: 0;
                overflow: hidden;
                visibility: hidden;
                width: 0;
            }

            table.logo {
                border-spacing: 2px 5px;
                padding: 0.6em 3.5em;
            }

            .logo-td {
                padding: 5px;
            }

            .title-td {
                padding: 0.6em 0;
                font-size: 1.3em;
                font-weight: 900;
            }

            .link-td {
                padding: 2em 0;
                text-align: center;
            }

            .leave-td {
                padding: 1.2em 0;
            }

            .regards {
                padding: 2em 0;
            }

            a.goto-link {
                background-color: #132249;
                text-decoration: none;
                color: #fff;
                padding: 0.6em 1.5em;
                text-align: center;
                display: inline-block;
                font-size: 1em;
                text-transform: uppercase;
                cursor: pointer;
                border-radius: 8px;
            }

            .footer {
                text-align: center;
                margin-top: 1em;
                width: 100%;
            }

            .footer .bot-logo {
                width: 6em;
            }
        </style>
        @stack('addon-style')
        </head>
    <body>
        @yield('email')

        <div class="footer">
        <img src="{{ asset('img/logo/himatif.png') }}" class="bot-logo" alt="Himatif USU"/>
        </div>

        @stack('addon-script')
    </body>
</html>
