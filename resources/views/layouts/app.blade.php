<!DOCTYPE html>
<html lang="eng">
    <head>
        <!-- Styles -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  		<link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <!--  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui"> -->
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