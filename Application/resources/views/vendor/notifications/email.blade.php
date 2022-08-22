@component('mail::message')
{{-- Greeting --}}
# {{$greeting}}
{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}
@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

@if (!empty($planTable))
<strong>{{ $planTable['title'] }}</strong>
@component('mail::table')
| {{ $planTable['head']['plan_name'] }} | {{ $planTable['head']['plan_interval'] }} | {{ $planTable['head']['plan_price'] }} |
| ------------------|:---------:|-------------:|
| {{ $planTable['body']['plan_name'] }} | {{ $planTable['body']['plan_interval'] }} | {{ $planTable['body']['plan_price'] }} |
@endcomponent
@endif

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}
@endforeach

{{-- Salutation --}}
{{ $salutation }},<br>
{{ $settings['website_name'] }}

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
{{ $subcopy }}
<span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endslot
@endisset
@endcomponent
