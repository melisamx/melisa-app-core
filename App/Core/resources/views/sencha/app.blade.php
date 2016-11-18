<?php  ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>{{ $title }}</title>
        
        <script type="text/javascript">            
            var Ext = Ext || {};
            
            /*
             * Solo si es necesario cargar manifest dinamico
             * En nuestro caso:
             * - Los recursos estaticos estan apuntados a otro(s) subdominio
             * - Los NameSpace son dinamicos por aplicación:
             *  - GW.clientes
             *  - GW.otro.namespace
             *  - Nerine
             * Nos da libertad de incluir al vuelo los scripts y css necesarios
             */
            Ext.beforeLoad = function (tags) {
                
                var s = location.search,  // the query string (ex "?foo=1&bar")
                    profile;

                // For testing look for "?classic" or "?modern" in the URL to override
                // device detection default.
                //
                if (s.match(/\bclassic\b/)) {
                    
                    profile = 'classic';
                    
                } else if (s.match(/\bmodern\b/)) {
                    
                    profile = 'modern';
                    
                } else {
                    
                    profile = tags.desktop ? 'classic' : 'modern';
                    
                }
                
                Ext.manifest = '{{ $urlManifest }}' + profile + '/?config';
                
            };            
        </script>    
        
        <script id="microloader" data-app="{{ $appId }}" type="text/javascript">
            {{!! $bootstrap !!}}
        </script>
    </head>
    
    <body id="main-body">
        
        <div id="loader" class="loader-wrapper animated">
            <div class="loader-content">
                <h2 class="loader">Espere un momento...</h2>
            </div>
            <img src="{{ $imagePoweredBy }}" alt="Logo" />
        </div>
        
    </body>
</html>
