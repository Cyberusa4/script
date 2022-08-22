<div class="modal fade" id="logModal" tabindex="-1" aria-labelledby="logModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logModalLabel">{{ __('Log details') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <ul class="custom-list-group list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        <strong><i class="fas fa-key me-2"></i>{{ __('IP Address') }} :</strong>
                        <span><a id="ip" href="#"></a></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong><i class="fas fa-map-marker-alt me-2"></i>{{ __('Location') }} :</strong>
                        <span id="location"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong><i class="far fa-clock me-2"></i>{{ __('Timezone') }} :</strong>
                        <span id="timezone"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong><i class="fas fa-street-view me-2"></i>{{ __('Latitude') }} :</strong>
                        <span class="text-success" id="latitude"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong><i class="fas fa-street-view me-2"></i>{{ __('Longitude') }} :</strong>
                        <span class="text-danger" id="longitude"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong><i class="fas fa-globe me-2"></i>{{ __('Browser') }} :</strong>
                        <span id="browser"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong><i class="fas fa-desktop me-2"></i>{{ __('OS') }} :</strong>
                        <span id="os"></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
