<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ $settings['website_name'] ?? 'Error' }} — @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset($settings['website_favicon'] ?? '') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/fontawesome/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/extra/colors.css') }}">
</head>
<style>
    body {
        font-family: 'Poppins', 'Almarai', sans-serif;
    }

    .vr__errors {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        min-height: 90vh;
        padding: 3rem;
    }

    .vr__errors .vr__sing__error {
        text-align: center;
    }

    .vr__errors .vr__sing__error .vr__error__code {
        margin: 0;
        font-weight: 600;
        font-size: 10rem;
    }

    .vr__errors .vr__sing__error .line {
        width: 150px;
        margin: 1rem auto;
        height: 3px;
        background: var(--primaryColor);
    }

    .vr__errors .vr__sing__error .vr__error__title {
        color: #585858;
        margin: 1rem 0;
    }

    @media (max-width:575.98px) {
        .vr__errors .vr__sing__error .vr__error__code {
            font-size: 5rem;
        }

        .vr__errors .vr__sing__error .line {
            width: 100px;
        }
    }

</style>

<body>
    <div class="vr__errors">
        <div class="vr__sing__error">
            <h1 class="vr__error__code">@yield('code')</h1>
            <div class="line"></div>
            <h1 class="vr__error__title">@yield('message')</h1>
            <div class="row">
                <div class="col-lg-7 m-auto">
                    <p>{{ lang('You can’t always get what you want. It’s true in life, and it’s true on the web — sometimes, what you’re looking for just isn’t there', 'error pages') }}.
                    </p>
                </div>
            </div>
            <a href="{{ url('/') }}" class="btn btn-dark"><i
                    class="fa fa-home me-1"></i>{{ lang('Back to home', 'error pages') }}</a>
        </div>
    </div>
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
