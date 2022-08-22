<div id="filemanager-rename-file-modal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title">{{ lang('Rename', 'file manager') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="filemanager-rename-modal-filename" class="mb-2 text-muted text-ellipsis"></p>
                <form id="filemanager-rename-file-form">
                    <input id="filemanager-rename-file-input" type="text" name="file_name"
                        class="form-control form-control-lg" placeholder="{{ lang('File Name', 'file manager') }}"
                        required />
                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-gradient me-2"
                            data-bs-dismiss="modal">{{ lang('Cancel', 'file manager') }}</button>
                        <button id="filemanager-rename-file-button"
                            class="btn btn-primary">{{ lang('Rename', 'file manager') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
