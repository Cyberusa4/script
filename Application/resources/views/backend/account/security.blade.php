@extends('backend.layouts.form')
@section('title', __('Account Security'))
@section('container', 'container-max-lg')
@section('content')
<form id="vironeer-submited-form" action="{{ route('admin.account.security.update') }}" method="POST">
    @csrf
    <div class="card p-2">
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">{{ __('Password') }} : <span class="red">*</span></label>
                <input type="password" class="form-control" name="current-password" required>
            </div>
            <div class="mb-3">
                <label class="form-label">{{__('New Password')}} : <span class="red">*</span></label>
                <input type="password" class="form-control" name="new-password" required>
            </div>
            <div class="mb-2">
                <label class="form-label">{{__('Confirm New Password')}} : <span class="red">*</span></label>
                <input type="password" class="form-control" name="new-password_confirmation" required>
            </div>
        </div>
    </div>
</form>
@endsection