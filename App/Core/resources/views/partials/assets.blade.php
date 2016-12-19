@foreach ($assets as $asset)
    @if ($asset['idAssetType'] == 2)
        <link id="{{ $asset['id'] }}" href="{{ $asset['url'] }}" rel="stylesheet" />
    @endif
    @if ($asset['idAssetType'] == 1)
        <script id="{{ $asset['id'] }}" src="{{ $asset['url'] }}"></script>
    @endif
@endforeach