<div class="contextmenu">
    <a class="contextmenu-item" data-bs-toggle="modal" data-bs-target="#share">
        <i class="fas fa-share-alt"></i>
        {{ lang('Share', 'preview') }}
    </a>
    <a href="{{ route('file.download', $fileEntry->shared_id) }}" target="_blank" class="contextmenu-item">
        <i class="fa fa-download"></i>
        {{ lang('Download', 'preview') }}
    </a>
</div>
