<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Taskify') }}</title>

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body class="d-flex flex-column min-vh-100">
        <div class="container-fluid text-end">
            <div class="row">
                <div class="col mt-3">
                    <a class="me-3 text-decoration-none t-lightgray fw-bold" href="{{ URL::route(Route::currentRouteName(), [], true, 'en') }}" id="loginlanguagebtn">EN</a>
                    <a class="me-3 text-decoration-none t-lightgray fw-bold" href="{{ URL::route(Route::currentRouteName(), [], true, 'de') }}" id="loginlanguagebtn">DE</a>
                    <a class="me-3 text-decoration-none t-lightgray fw-bold" href="{{ URL::route(Route::currentRouteName(), [], true, 'it') }}" id="loginlanguagebtn">IT</a>
                </div>
            </div>
        </div>
        @if (Session::has('message'))

            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>

        @endif
        <div class="container my-auto">
            <div class="row justify-content-center text-center" id="loginlogo">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" />
                <p class="fw-bold t-orange">Taskify</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card bg-transparent t-white border-0" id="logincard">
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('login.label.email') }}</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control th-lightgray border-0 @isset($_GET['errormsg']) is-invalid @endisset" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @isset($_GET['errormsg'])

                                            <span class="invalid-feedback">
                                                <strong>{{ $_GET['errormsg'] }}</strong>
                                            </span>

                                        @endisset
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('login.label.password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control th-lightgray border-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input th-lightgray border-0" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('login.rememberme') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary th-orange t-gray fw-bold border-0" id="loginbtn"> {{ __('login.login') }}</button>
                                        @if (Route::has('password.request'))

                                            <a class="btn btn-link t-orange" href="{{ route('password.request') }}" id="loginforgotpw">{{ __('login.forgot') }}</a>

                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
