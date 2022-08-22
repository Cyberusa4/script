<div id="share" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 pt-1 mb-1">
                <h5 class="mb-4"><i class="fas fa-share-alt me-2"></i>{{ lang('Share this file') }}</h5>
                <p class="mb-4 text-ellipsis"><strong>{{ $fileEntry->name }}</strong></p>
                @if ($fileEntry->access_status)
                    <div class="mb-3">
                        <div class="share">
                            {!! shareButtons(url()->current()) !!}
                        </div>
                    </div>
                    @if (isFileSupportPreview($fileEntry->type))
                        <div class="mb-3">
                            <label class="form-label"><strong>{{ lang('Preview link') }}</strong></label>
                            <div class="input-group">
                                <input id="copy-preview-link" type="text" class="form-control"
                                    value="{{ route('file.preview', $fileEntry->shared_id) }}" readonly>
                                <button type="button" class="btn btn-primary btn-md copy"
                                    data-clipboard-target="#copy-preview-link"><i class="far fa-clone"></i></button>
                            </div>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label"><strong>{{ lang('Download link') }}</strong></label>
                        <div class="input-group">
                            <input id="copy-download-link" type="text" class="form-control"
                                value="{{ route('file.download', $fileEntry->shared_id) }}" readonly>
                            <button type="button" class="btn btn-primary btn-md copy"
                                data-clipboard-target="#copy-download-link"><i class="far fa-clone"></i></button>
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger">
                        <i
                            class="fas fa-exclamation-circle me-2"></i>{{ lang('Files with private access cannot be shared') }}
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>
