<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Taskify') }} - @yield('title')</title>

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        {{-- Favicon --}}
        <link rel="icon" href="{{ url('img/logo.png') }}">

        {{-- @stack() --}}
    </head>
    <body class="d-flex flex-column min-vh-100">
        {{-- Header --}}
        <header class="container-fluid position-fixed th-gray">
            <div class="row">
                {{-- Searchbar --}}
                <div class="col-4 my-auto">
                    <form method="GET" action="{{URL::route('assignment.index')}}">
                        @csrf
                        @method('GET')
                        <input class="rounded-start ps-3 align-middle th-lightgray border-0 fw-bold placeholder-gray i-outline-none" type="text" name="search" id="searchtext" value="@if(isset($filter['search'])){{ $filter['search'] }}@endif" placeholder="{{ __('header.searchbar.placeholder') }}" />
                        {{-- Hidden Assignment Filter Fields --}}
                        @if (isset($filter))

                            @foreach ($filter as $key => $f)

                                @if (isset($f) && $key != "search")

                                    <input type="text" name="{{ $key }}" value="{{ $f }}" hidden>

                                @endif

                            @endforeach

                        @endif
                        {{-- Search Button --}}
                        <button class="rounded-end align-middle th-lightgray border-0" type="submit" id="searchbutton" title="{{ __('header.searchbar.button') }}">
                            <img class="t-gray" src="{{ asset('img/icons/search.svg') }}" alt="Search">
                        </button>
                    </form>
                </div>
                {{-- Logo --}}
                <div class="col-4 my-auto text-center">
                    <a class="text-decoration-none t-orange fs-1 fw-bold" href="{{ URL::route('home') }}" id="logolink">
                        <img src="{{ asset('img/logo.png') }}" alt="Taskify Logo" id="logoimg">
                        <span>{{ __('header.brand.name') }}</span>
                    </a>
                </div>
                <div class="col-4 text-end my-auto">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-end my-auto p-0">
                                {{-- Language-Dropdown --}}
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle text-uppercase th-gray t-lightgray fw-bold border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="languagedropdown" title="{{ __('header.language') }}">
                                        {{ app()->getLocale() }}
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark shadow th-lightergray" id="languagedropdownul">
                                        @forelse ($langs as $lang)

                                            <li>
                                                <a class="dropdown-item text-uppercase t-white fw-bold" href="{{ Route::localizedUrl($lang) }}">{{ $lang }}</a>
                                            </li>

                                        @empty

                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                            <div class="col-auto p-0">
                                {{-- Profile-Dropdown --}}
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle p-0 th-gray t-lightgray border-0 d-dropdownafter-none" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="profiledropdown" title="{{ __('header.profile') }}">
                                        @if (!Auth::check() || Auth::user()->gravatar)

                                            <img class="rounded-circle t-gray th-lightgray img-40" src="{{ Auth::user()->gravatar }}" alt="Profile">

                                        @endif
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark shadow th-lightergray" id="profiledropdownul">
                                        <li>
                                            <a class="dropdown-item t-white fw-bold" href="{{ URL::route('users.edit-profile') }}">{{ __('header.profile.myprofile') }}</a>
                                        </li>
                                        @if (Auth::user()->isAdmin())

                                            <li>
                                                <a class="dropdown-item t-white fw-bold" href="{{ URL::route('users') }}">{{ __('header.profile.adminpanel') }}</a>
                                            </li>

                                        @endif
                                        <div class="dropdown-divider border border-1 bc-lightgray" id="dropdowndivider"></div>
                                        <li>
                                            <a class="dropdown-item t-white fw-bold" href="{{ URL::route('logout') }}">{{ __('header.profile.logout') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container-fluid flex-fill d-flex p-0">
            <div class="row w-100 p-0 m-0">
                {{-- Sidebar --}}
                <div class="col-1 h-100 position-fixed th-gray" id="sidebar">
                    <a class="rounded mb-3 d-block text-decoration-none th-lightgray" href="{{ URL::route('home') }}" title="{{ __('sidebar.home') }}" id="sidebarlink">
                        <img class="p-1 rounded th-lightgray img-40" src="{{ asset('/img/icons/house.svg') }}" alt="{{ __('sidebar.home') }}">
                        <span class="sidebarlinknames align-middle ms-2 text-decoration-none t-gray fw-bold fs-4 d-none">{{ __('sidebar.home') }}</span>
                    </a>
                    <a class="rounded mb-3 d-block text-decoration-none th-lightgray" href="{{ URL::route('assignment.create') }}" title="{{ __('sidebar.createassignment') }}" id="sidebarlink">
                        <img class="p-1 rounded th-lightgray img-40" src="{{ asset('/img/icons/plus.svg') }}" alt="{{ __('sidebar.createassignment') }}">
                        <span class="sidebarlinknames align-middle ms-2 text-decoration-none t-gray fw-bold fs-4 d-none">{{ __('sidebar.createassignment') }}</span>
                    </a>
                    <a class="rounded mb-3 d-block text-decoration-none th-lightgray" href="{{ URL::route('assignment.index') }}" title="{{ __('sidebar.assignments') }}" id="sidebarlink">
                        <img class="p-1 rounded th-lightgray img-40" src="{{ asset('/img/icons/clipboard-list.svg') }}" alt="{{ __('sidebar.assignments') }}">
                        <span class="sidebarlinknames align-middle ms-2 text-decoration-none t-gray fw-bold fs-4 d-none">{{ __('sidebar.assignments') }}</span>
                    </a>
                    <a class="rounded mb-3 d-block text-decoration-none th-lightgray" href="{{ URL::route('workshop.index') }}" title="{{ __('sidebar.workshops') }}" id="sidebarlink">
                        <img class="p-1 rounded th-lightgray img-40" src="{{ asset('img/icons/warehouse.svg') }}" alt="{{ __('sidebar.workshops') }}">
                        <span class="sidebarlinknames align-middle ms-2 text-decoration-none t-gray fw-bold fs-4 d-none">{{ __('sidebar.workshops') }}</span>
                    </a>
                    <div class="fixed-bottom text-end" id="arrowsdiv">
                        <button class="position-relative mb-2 me-3 mx-auto bg-transparent border-0 img-40" id="arrows" title="{{ __('sidebar.open') }}" onclick="toggle()">
                            <img class="rounded img-40" id="arrow" src="{{ asset('/img/icons/arrows-right.svg') }}" alt="{{ __('sidebar.open') }}">
                        </button>
                    </div>
                </div>
                {{-- Content --}}
                <main class="col p-3" id="main">
                    @if (Session::has('message'))

                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>

                    @endif

                    @if ($errors->any())

                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach
                            </ul>
                        </div>

                    @endif
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>
