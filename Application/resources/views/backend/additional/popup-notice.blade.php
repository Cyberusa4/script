@extends('backend.layouts.form')
@section('title', __('PopUp Notice'))
@section('container', 'container-max-lg')
@section('content')
<form id="vironeer-submited-form" action="{{ route('admin.additional.notice.update') }}" method="POST">
    @csrf
    <div class="card">
       <div class="card-body my-2">
          <div class="row">
              <div class="col-lg-2">
                <div class="mb-3">
                    <label class="form-label">{{ __('Status') }} :</label>
                    <input type="checkbox" name="popup_notice_status" data-toggle="toggle" @if($additionals['popup_notice_status']) checked @endif>
                </div>
              </div>
          </div>
          <div class="mb-0">
             <label class="form-label">{{ __('PopUp description') }} :</label>
             <textarea name="popup_notice_description" id="content-small" rows="10" class="form-control">{{ $additionals['popup_notice_description'] }}</textarea>
          </div>
       </div>
    </div>
</form>
@endsection