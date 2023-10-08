@extends('layouts.app')

@section('title', __('header.profile.myprofile'))

@section('content')

    <div class="container-fluid h-100 p-0" id="profile">
        <div class="row h-100 p-0">
            <div class="col my-auto p-0">
                {{-- Profile Badge --}}
                <div class="container-fluid mt-5 mb-3">
                    <div class="row justify-content-center text-center">
                        <div class="col-3">
                            <div class="rounded-3 th-gray border border-2 bc-lightergray th-gray" id="profilebadgediv">
                                <img class="mb-2 rounded-circle th-lightgray img-80" src="{{ \App\Models\User::find($user->id)->gravatar }}"alt="{{ __('header.profile') }}" id="profilebadgeimg" />
                                <h2>{{ $user->name }}</h2>
                                @foreach ($user->role_ids as $role_id)

                                    @if ($role_id == '1')

                                        <p class="badge bg-warning th-red fs-6" id="profilebadgetext">@lang('home.team.admin')</p>

                                    @elseif ($role_id == '2')

                                        <p class="badge bg-warning th-blue fs-6" id="profilebadgetext">@lang('home.team.technician')</p>

                                    @else

                                        <p class="badge bg-warning th-yellow fs-6" id="profilebadgetext">@lang('home.team.supporter')</p>

                                    @endif

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Forms --}}
                <div class="container-fluid mt-4">
                    {{-- Update Profile --}}
                    <div class="row justify-content-center">
                        <div class="col-6 rounded-3 th-gray p-3" id="profileformdiv">
                            <h3 class="mb-4 t-orange">@lang('profile.updateprofile')</h3>
                            <form action="{{ URL::route('users.update-profile') }}" method="post" id="profileform">
                                @csrf
                                @method('PUT')
                                <div class="container-fluid px-2">
                                    {{-- Name --}}
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="name">@lang('profile.label.name')</label>
                                        </div>
                                        <div class="col ps-0">
                                            <input class="rounded-2 mb-2 w-100 ps-2 th-lightgray border-0 i-outline-none placeholder-gray" type="text" name="name" id="name" value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    {{-- Email Address --}}
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="email">@lang('profile.label.email')</label>
                                        </div>
                                        <div class="col ps-0">
                                            <input class="rounded-2 mb-3 w-100 ps-2 th-lightgray border-0 i-outline-none placeholder-gray" type="text" name="email" id="email" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-auto">
                                            <button class="btn btn-primary th-orange t-gray fw-bold border-0" id="profilesavebtn">@lang('profile.updateprofile')</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- Change Password --}}
                    <div class="row mt-4 justify-content-center">
                        <div class="col-6 rounded-2 th-gray p-3" id="passwordformdiv">
                            <h3 class="mb-4 t-orange">@lang('profile.updatepassword')</h3>
                            <form action="{{ URL::route('users.update-password') }}" method="post" id="passwordform">
                                @csrf
                                @method('POST')
                                <div class="container-fluid px-2">
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="currentPassword">@lang('profile.label.current')</label>
                                        </div>
                                        <div class="col ps-0">
                                            <input class="rounded-2 mb-2 w-100 ps-2 th-lightgray border-0 i-outline-none placeholder-gray" type="password" name="currentPassword" id="currentPassword" placeholder="@lang('profile.label.current')">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="newPassword">@lang('profile.label.new')</label>
                                        </div>
                                        <div class="col ps-0">
                                            <input class="rounded-2 mb-2 w-100 ps-2 th-lightgray border-0 i-outline-none placeholder-gray" type="password" name="newPassword" id="newPassword" placeholder="@lang('profile.label.new')">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="newPassword">@lang('profile.label.repeat')</label>
                                        </div>
                                        <div class="col ps-0">
                                            <input class="rounded-2 mb-3 w-100 ps-2 th-lightgray border-0 i-outline-none placeholder-gray" type="password" name="newPassword2" id="newPassword2" placeholder="@lang('profile.label.repeat')">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-auto">
                                            <button class="btn btn-primary th-orange t-gray fw-bold border-0" id="passwordsavebtn">@lang('profile.updatepassword')</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
