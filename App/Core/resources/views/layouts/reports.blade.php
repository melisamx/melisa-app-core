<!DOCTYPE html>
<html lang="es" class="full-heigth">
    <head>
        <title>{{ isset($pageTitle) ? $pageTitle : '' }}</title>
        @if( isset($assets['header']))
            @include('partials.assets', array('assets'=>$assets['header']))
        @endif
        @yield('head')
    </head>
    
    <body class="full-heigth">
        @yield('content')
        @if( isset($assets['footer']))
            @include('partials.assets', array('assets'=>$assets['footer']))
        @endif
        @yield('footer')
    </body>
</html>
