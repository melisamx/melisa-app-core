@if ( !isset($assets['idAssetType']) )

@foreach ($assets as $asset)
    @if ($asset['idAssetType'] == 2)
        <link id="{{ $asset['id'] }}" href="{{ $asset['url'] }}" rel="stylesheet" />
    @endif
    @if ($asset['idAssetType'] == 1)
        <script id="{{ $asset['id'] }}" src="{{ $asset['url'] }}"></script>
    @endif
@endforeach

@else
    
    @if ($assets['idAssetType'] == 2)
        <link id="{{ $assets['id'] }}" href="{{ $assets['url'] }}" rel="stylesheet" />
    @endif
    @if ($assets['idAssetType'] == 1)
        <script id="{{ $assets['id'] }}" src="{{ $assets['url'] }}"></script>
    @endif
    
@endif
