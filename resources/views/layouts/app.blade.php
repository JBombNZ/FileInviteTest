<!DOCTYPE html>
<html lang="eng">
    <head>
        <!-- Styles -->
        <link href="/css/font.css" rel="stylesheet">
        <link href="/css/materialdesignicons.min.css" rel="stylesheet">
        <link href="/css/vuetify.min.css" rel="stylesheet">
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </head>

    <body>
        <div id="app">

            @yield('content')

        </div>

        <!-- the js files that are compiled -->
        <script src="{{ mix('js/app.js') }}"></script>
        @stack('scripts')
    </body>
</html>
