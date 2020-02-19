<!doctype html>
<html lang="{{ app()->getLocale() }}">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ config('app.name') }}</title>
        <link href="{{ mix('css/bx24/v1/main.css') }}" rel="stylesheet">
    </head>

    <body>
        <div id="app">
            <div class="main-panel">
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid d-flex flex-wrap justify-content-between">
                        <nav></nav>
                        <div class="copyright">
                            @php
                                $year = date('Y');
                            @endphp
                            @lang('bx24.v1.copyright', compact('year'))
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script src="//api.bitrix24.com/api/v1/" defer></script>
        @yield('scripts')
    </body>

</html>


