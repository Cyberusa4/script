<div id="filemanager-create-folder-modal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title">{{ lang('Create Folder', 'file manager') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2 text-muted">{{ lang('Give this folder a name', 'file manager') }}</p>
                <form id="create-folder-form">
                    @if (request()->routeIs('filemanager.showFolder'))
                        <input type="hidden" name="parent_id" value="{{ hashid($folder->id) }}">
                    @endif
                    <input id="create-folder-name-input" type="text" name="folder_name"
                        class="form-control form-control-lg" placeholder="{{ lang('Folder Name', 'file manager') }}"
                        required />
                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-gradient me-2"
                            data-bs-dismiss="modal">{{ lang('Cancel', 'file manager') }}</button>
                        <button id="create-folder-button" type="submit"
                            class="btn btn-primary">{{ lang('Create', 'file manager') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
