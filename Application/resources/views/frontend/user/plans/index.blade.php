@extends('frontend.user.layouts.auth')
@section('title', lang('Pricing plans', 'plans'))
@section('section', lang('User', 'user'))
@section('content')
    <div class="user-plans my-4">
        <div class="user-plans-header text-center mb-4">
            @if (request()->input('st') == 'subscribe')
                <i class="fas fa-check-circle"></i>
                <h2>{{ lang('Choose your plan to complete the subscription', 'user') }}</h2>
            @else
                <i class="far fa-gem"></i>
                <h2>{{ lang('Pricing plans', 'plans') }}</h2>
            @endif
        </div>
        @include('frontend.global.includes.plans')
    </div>
@endsection
