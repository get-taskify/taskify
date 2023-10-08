<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Taskify') }}</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <form class="d-flex" role="search">
                    @csrf
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </nav>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">
                    <i class="fa-solid fa-user fa-2xl"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-block bg-primary" href="#">Link 2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
            </li>
        </ul>
        {{-- Navbar --}}
        <nav class="navbar bg-dark">
            <div class="container-fluid">
                <div class="border-top">
                    <a class="d-flex align-items-center justify-content-center p-3 link-light text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false" href="">
                        <i class="fa-solid fa-user fa-2xl"></i>
                    </a>
                    <ul class="dropdown-menu text-small shadow">
                        <li>
                            <a href="#" class="dropdown-item"><i class="fa-solid fa-user"></i>
                                {{ __('Your Profile') }}</a>
                        </li>
                        <li>
                            <a href="#" class="dropdown-item"><i class="fa-solid fa-user-gear"></i>
                                {{ __('Admin Panel') }}</a>
                        </li>
                        <li>
                            <a href="#" class="dropdown-item"><i class="fa-solid fa-right-from-bracket"></i>
                                {{ __('Logout') }}</a>
                        </li>
                    </ul>
                </div>
        </nav>


        <div class="container-fluid">
            <div class="row">
                {{-- Sidebar --}}
                <div class="sidebar">
                    <div class="col-1">
                        <nav class="d-flex flex-column flex-shrink-0 navbar navbar-expand-lg shadow-sm bs-side-navbar">
                            {{-- Hamburger --}}
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse navbar-collapse" id="navbarSupportedContent">
                                {{-- Sidebar Of Navbar --}}
                                <ul class="navbar-nav">
                                    {{-- Home --}}
                                    <li class="nav-item active">
                                        <a href="#" class="nav-link"><i class="fa-solid fa-house fa-2xl"></i></a>
                                    </li>
                                    {{-- Create --}}
                                    <li class="nav-item">
                                        <a href="#" class="nav-link"><i
                                                class="fa-solid fa-square-plus fa-2xl"></i></a>
                                    </li>
                                    {{-- Assignment List --}}
                                    <li class="nav-item">
                                        <a href="#" class="nav-link"><i class="fa-solid fa-list fa-2xl"></i></a>
                                    </li>
                                    {{-- Workshops --}}
                                    <li class="nav-item">
                                        <a href="#" class="nav-link"><i class="fa-solid fa-shop fa-2xl"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>

                <main class="col-11">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
