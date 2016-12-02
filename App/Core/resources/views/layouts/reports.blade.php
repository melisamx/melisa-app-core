<!DOCTYPE html>
<html lang="es">
    <head>
        <title></title>
        @include('partials.assets', array('assets'=>$assets['header']))
        @yield('head')
    </head>
    
    <body>
        @yield('content')
    </body>
</html>
