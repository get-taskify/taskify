@extends('layouts.app')

@section('title', __('header.profile.adminpanel'))

@section('content')

    <div id="adminpanel">
        <h1 class="t-orange fw-bold">@lang('admin.panel')</h1>
        <div class="container-fluid">
            {{-- User Management --}}
            @if ($users->count() > 0)

                <div class="row th-gray rounded-3 pt-2 mb-3" id="usermanagement">
                    <h3>@lang('admin.usermanagement')</h3>
                    <div class="row text-center my-auto mb-3 mt-4">
                        @foreach ($users as $user)

                            @if ($usercounter == 0 || $usercounter % 4)

                            <div class="col-3">
                                <div class="rounded-2 h-100 border border-2 bc-lightergray" id="userdiv">
                                    <img class="mb-3 rounded-circle th-lightgray img-50" src="{{ \App\Models\User::find($user->id)->gravatar }}" alt="{{ __('header.profile') }}" id="userprofileimg" />
                                    {{-- Delete User Form --}}
                                    <form method="POST" action="{{ route('users.destroy', $user) }}" id="userdestroy{{$usercounter}}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    {{-- Edit User Form --}}
                                    <form action="{{ URL::route('users.update-permissions') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col">
                                                    {{-- Name Input --}}
                                                    <h5 class="text-center fw-bold" id="usernameinput">
                                                        <input class="rounded-2 mb-1 w-100 text-center py-1 fw-bold bg-transparent i-outline-none border border-2 bc-lightgray t-white" type="text" name="name" id="name{{$user->id}}" value="{{ $user->name }}">
                                                    </h5>
                                                    {{-- Email Input --}}
                                                    <div id="useremailinput">
                                                        <input class="rounded-2 w-100 text-center py-1 fw-bold bg-transparent i-outline-none border border-2 bc-lightgray t-white" type="text" name="email" id="email{{$user->id}}" value="{{ $user->email }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row mb-3">
                                                {{-- Role Dropdown --}}
                                                <div class="col-5 ms-auto">
                                                    <div class="dropdown rounded-2 border border-2 bc-lightgray" id="roledropdowndiv">
                                                        <button class="btn btn-secondary dropdown-toggle text-uppercase th-gray t-lightgray fw-bold border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="roledropdown{{$user->id}}">
                                                            @lang('admin.roles')
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-dark shadow w-100 th-lightergray" id="roledropdownul">
                                                            @foreach ($roles as $key => $role)

                                                                <div class="text-center">
                                                                    <input class="form-check-input" type="checkbox" value="{{$key}}" id="{{ $roles[$key] }}-{{$user->id}}" name="roles[]" @if (in_array($key, $user->user_roles)) checked @endif>
                                                                    <label class="form-check-label" for="{{ $roles[$key] }}-{{$user->id}}">{{$roles[$key]}}</label>
                                                                </div>

                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                {{-- Change Password Button --}}
                                                <div class="col-5 me-auto">
                                                    <button class="btn btn-primary border border-2 bc-orange bg-transparent t-orange" type="button" onclick="showChangePassword({{$usercounter}})" id="changepasswordbtn-{{$user->id}}">@lang('profile.updatepassword')</button>
                                                </div>
                                            </div>
                                            {{-- Change Password Div --}}
                                            <div class="row d-none" id="changepassworddiv">
                                                <div class="col-5 ms-auto">
                                                    <input class="rounded-2 w-100 ps-2 h-100 th-lightgray border-0 i-outline-none placeholder-gray" type="password" name="newPassword" id="newPassword{{$user->id}}" placeholder="@lang('profile.label.new')">
                                                </div>
                                                <div class="col-5 me-auto">
                                                    <button class="btn btn-primary w-100 th-orange t-gray border border-2 bc-orange fw-bold" type="button" onclick="hideChangePassword({{$usercounter}})" id="cancelpasswordbtn-{{$user->id}}">@lang('home.news.create.cancel')</button>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row text-center mb-3">
                                                {{-- Save Button --}}
                                                <div class="col-5 ms-auto">
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    <button class="btn btn-primary w-100 th-orange t-gray border border-2 bc-orange fw-bold" type="submit" id="savebtn{{$user->id}}">@lang('home.news.create.save')</button>
                                                </div>
                                                {{-- Delete Button --}}
                                                <div class="col-5 me-auto">
                                                    <button class="btn btn-primary w-100 border border-2 bc-orange bg-transparent t-orange" type="button" onclick="changeModalSubmitButton('userdestroy{{$usercounter}}'), changeModalText('@lang('delete.sure.user')')" data-bs-toggle="modal" data-bs-target="#deletemodal">
                                                        @lang('admin.deleteuser')
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            @else

                                </div>
                                <div class="row text-center my-auto mb-3 mt-4">
                                    <div class="col-3">
                                        <div class="rounded-2 h-100 border border-2 bc-lightergray" id="userdiv">
                                            <img class="mb-3 rounded-circle th-lightgray img-50" src="{{ \App\Models\User::find($user->id)->gravatar }}" alt="{{ __('header.profile') }}" id="userprofileimg" />
                                            {{-- Delete User Form --}}
                                            <form method="POST" action="{{ route('users.destroy', $user) }}" id="userdestroy{{$usercounter}}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            {{-- Edit User Form --}}
                                            <form action="{{ URL::route('users.update-permissions') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col">
                                                            {{-- Name Input --}}
                                                            <h5 class="text-center" id="usernameinput">
                                                                <input class="rounded-2 mb-1 w-100 text-center py-1 fw-bold bg-transparent i-outline-none border border-2 bc-lightgray t-white" type="text" name="name" id="name{{$user->id}}" value="{{ $user->name }}">
                                                            </h5>
                                                            {{-- Email Input --}}
                                                            <div id="useremailinput">
                                                                <input class="rounded-2 w-100 text-center py-1 fw-bold bg-transparent i-outline-none border border-2 bc-lightgray t-white" type="text" name="email" id="email{{$user->id}}" value="{{ $user->email }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                    <div class="row mb-3">
                                                        {{-- Role Dropdown --}}
                                                        <div class="col-5 ms-auto">
                                                            <div class="dropdown rounded-2 border border-2 bc-lightgray" id="roledropdowndiv">
                                                                <button class="btn btn-secondary dropdown-toggle text-uppercase th-gray t-lightgray fw-bold border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="roledropdown{{$user->id}}">
                                                                    @lang('admin.roles')
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-dark shadow w-100 th-lightergray" id="roledropdownul">
                                                                    @foreach ($roles as $key => $role)

                                                                        <div class="text-center">
                                                                            <input class="form-check-input" type="checkbox" value="{{$key}}" id="{{ $roles[$key] }}" name="roles[]" @if (in_array($key, $user->user_roles)) checked @endif>
                                                                            <label class="form-check-label" for="{{ $roles[$key] }}">{{$roles[$key]}}</label>
                                                                        </div>

                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        {{-- Change Password Button --}}
                                                        <div class="col-5 me-auto">
                                                            <button class="btn btn-primary border border-2 bc-orange bg-transparent t-orange" type="button" onclick="showChangePassword({{$usercounter}})" id="changepasswordbtn-{{$user->id}}">@lang('profile.updatepassword')</button>
                                                        </div>
                                                    </div>
                                                    {{-- Change Password Div --}}
                                                    <div class="row d-none" id="changepassworddiv">
                                                        <div class="col-5 ms-auto">
                                                            <input class="rounded-2 w-100 ps-2 h-100 th-lightgray border-0 i-outline-none" type="password" name="newPassword" id="newPassword{{$user->id}}" placeholder="@lang('profile.label.new')">
                                                        </div>
                                                        <div class="col-5 me-auto">
                                                            <button class="btn btn-primary w-100 th-orange t-gray border border-2 bc-orange fw-bold" type="button" onclick="hideChangePassword({{$usercounter}})" id="cancelpasswordbtn-{{$user->id}}">@lang('home.news.create.cancel')</button>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                    <div class="row text-center mb-3">
                                                        {{-- Save Button --}}
                                                        <div class="col-5 ms-auto">
                                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                            <button class="btn btn-primary w-100 th-orange t-gray border border-2 bc-orange fw-bold" type="submit" id="savebtn{{$user->id}}">@lang('home.news.create.save')</button>
                                                        </div>
                                                        {{-- Delete Button --}}
                                                        <div class="col-5 me-auto">
                                                            <button class="btn btn-primary w-100 border border-2 bc-orange bg-transparent t-orange" type="button" onclick="changeModalSubmitButton('userdestroy{{$usercounter}}'), changeModalText('@lang('delete.sure.user')')" data-bs-toggle="modal" data-bs-target="#deletemodal">
                                                                @lang('admin.deleteuser')
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                            @endif

                            @php

                                $usercounter++;

                            @endphp

                        @endforeach
                        {{-- Add Member--}}
                        @if ($usercounter % 4 == 0)

                            <div class="row text-center my-auto mb-3 mt-4">

                        @endif
                            <div class="col-3">
                                <div class="container-fluid p-0 rounded-2 h-100 d-flex align-items-center border border-2 bc-orange" id="addmemberdiv" onmouseover="addMemberHover(addmemberimg);" onmouseout="addMemberUnhover(addmemberimg);">
                                    <button type="button" class="btn btn-primary mx-auto bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#addmembermodal">
                                        <div class="row h-100">
                                            <div class="col my-auto">
                                                <img class="mb-2 img-50" src="{{ asset('/img/icons/plus-solid.svg') }}" alt="@lang('admin.plus')" id="addmemberimg">
                                                <h5 class="t-orange">@lang('admin.addmember')</h5>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{-- Add Member Modal --}}
                        <div class="modal fade" id="addmembermodal" tabindex="-1" aria-labelledby="addmembermodallabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content th-gray">
                                    <form action="{{ route('users.store') }}" method="POST">
                                        @csrf
                                        {{-- Add Member Modal Header --}}
                                        <div class="modal-header bc-lightergray" id="addmemberheader">
                                            <h1 class="modal-title fs-5" id="addmembermodallabel">@lang('admin.addmember')</h1>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" id="addmemberclosex"></button>
                                        </div>
                                        {{-- Add Member Modal Body --}}
                                        <div class="modal-body" id="addmemberbody">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col">
                                                        {{-- Name Input --}}
                                                        <h5 id="usernameinput">
                                                            <input class="col rounded-2 w-100 mb-1 py-1 ps-1 fw-bold bg-transparent i-outline-none border border-2 bc-lightgray t-white" type="text" name="name" id="name" placeholder="@lang('profile.label.name')">
                                                        </h5>
                                                        {{-- Email Input --}}
                                                        <h5 id="useremailinput">
                                                            <input class="rounded-2 w-100 py-1 ps-1 fw-bold bg-transparent i-outline-none border border-2 bc-lightgray t-white" type="text" name="email" id="email" placeholder="@lang('login.label.email')">
                                                        </h5>
                                                        {{-- Password Input --}}
                                                        <h5 id="userpasswordinput">
                                                            <input class="rounded-2 w-100 py-1 ps-1 fw-bold bg-transparent i-outline-none border border-2 bc-lightgray t-white" type="password" name="password" id="password" placeholder="@lang('login.label.password')">
                                                        </h5>
                                                    </div>
                                                </div>
                                                <hr />
                                                {{-- Roles --}}
                                                <div class="row text-start">
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <h5>@lang('admin.roles'):</h5>
                                                        </div>
                                                    </div>
                                                    <div class="row ps-4 pe-0">
                                                        {{-- Admin --}}
                                                        <div class="col rounded rounded-2 py-1 ps-1 me-1 border border-2 bc-lightgray" id="addmembercheckbox">
                                                            <input class="form-check-input" type="checkbox" value="1" id="admin" name="roles[]">
                                                            <label class="form-check-label" for="admin">@lang('home.team.admin')</label>
                                                        </div>
                                                        {{-- Technician --}}
                                                        <div class="col rounded rounded-2 py-1 ps-1 me-1 border border-2 bc-lightgray" id="addmembercheckbox">
                                                            <input class="form-check-input" type="checkbox" value="2" id="technician" name="roles[]">
                                                            <label class="form-check-label" for="technician">@lang('home.team.technician')</label>
                                                        </div>
                                                        {{-- Supporter --}}
                                                        <div class="col rounded rounded-2 py-1 ps-1 border border-2 bc-lightgray" id="addmembercheckbox">
                                                            <input class="form-check-input" type="checkbox" value="3" id="supporter" name="roles[]">
                                                            <label class="form-check-label" for="supporter">@lang('home.team.supporter')   </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Add Member Modal Footer --}}
                                        <div class="modal-footer bc-lightergray" id="addmemberfooter">
                                            <button type="submit" class="btn btn-primary th-orange bc-orange t-gray fw-bold border border-2" id="addmembersavebtn">@lang('home.news.create.save')</button>
                                            <button type="button" class="btn btn-secondary border border-2 bc-orange t-orange bg-transparent" data-bs-dismiss="modal" id="addmemberclosebtn">@lang('admin.close')</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @if ($usercounter == 0 || $usercounter % 4)

                                <div class="col"></div>

                        @endif
                </div>

            @endif

            {{-- Default Tasks --}}
            <div class="row th-gray rounded-3 pt-2 mb-3" id="defaulttasks">
                <h3>@lang('admin.default')</h3>
                <div class="row pe-0 me-0 pb-1" id="defaulttaskdiv">
                    {{-- Tasks --}}
                    @empty($defaulttask)
                    @foreach ($defaulttasks as $defaulttask)

                        {{-- Delete Default Task Form --}}
                        <form method="POST" action="{{ route('default_task.destroy', $defaulttask) }}" id="defaulttaskdestroy{{$defaulttask->id}}">
                            @csrf
                            @method('DELETE')
                        </form>
                        {{-- Edit Default Task Form --}}
                        <form action="{{ route('default_task.update', $defaulttask) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-2">
                                <div class="row">
                                    {{-- Device Type --}}
                                    <div class="col-1 pe-0" id="devicetypediv">
                                        <div class="dropdown rounded-2" id="dropdowndiv">
                                            <button class="btn btn-secondary dropdown-toggle text-start w-100 border border-2 bc-lightgray bg-transparent t-white fs-5 opacity-100 scssdevicetypedropdownbtn" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="devicetypedropdownbtn{{$defaulttask->id}}" disabled>
                                                {{$devicetypes[$defaulttask->device_type]}}
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-dark shadow w-100 th-lightergray" id="dropdownul">
                                                @foreach ($devicetypes as $key => $devicetype)

                                                    <li class="text-center" id="dropdownitemdiv">
                                                        <input class="form-check-input" type="radio" name="device_type" value="{{$key}}" id="devicetyperadio{{$defaulttask->id}}{{ $key }}" @if ($key == $defaulttask->device_type) checked @endif hidden>
                                                        <label class="form-check-label t-white" for="devicetyperadio{{$defaulttask->id}}{{ $key }}" onclick="changeDevicetypedropdownbtnValue('{{$devicetype}}', {{$key}}, {{$defaulttask->id}})">{{$devicetype}}</label>
                                                    </li>

                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    {{-- Task --}}
                                    <div class="col">
                                        <input class="rounded-2 w-100 h-100 p-1 border border-2 bc-lightgray bg-transparent t-white fs-5 i-outline-none scssdefaulttasktext" type="text" name="text" id="defaulttasktext{{$defaulttask->id}}" value="{{ $defaulttask->text }}" disabled>
                                    </div>
                                    {{-- Edit Button --}}
                                    <div class="col-auto me-2 p-0">
                                        <button class="btn btn-primary m-0 h-100 border border-2 bc-orange bg-transparent t-orange" type="button" onclick="showDefaulttaskEdit({{$defaulttask->id}})" id="defaulttaskedit{{$defaulttask->id}}">
                                            <img class="img-w-20" src="{{ asset('/img/icons/pen.svg') }}" alt="@lang('admin.edit')">
                                        </button>
                                    </div>
                                    {{-- Delete Button --}}
                                    <div class="col-auto rounded-2 p-0">
                                        <button class="btn btn-primary m-0 h-100 border border-2 bc-orange bg-transparent t-orange th-orange" type="button" name="defaulttaskdelete" onclick="changeModalSubmitButton('defaulttaskdestroy{{$defaulttask->id}}'), changeModalText('@lang('delete.sure.defaulttask')')" data-bs-toggle="modal" data-bs-target="#deletemodal">
                                            <img class="img-w-20" src="{{ asset('/img/icons/gray/minus-solid.svg') }}" alt="@lang('admin.delete')">
                                        </button>
                                    </div>
                                </div>

                                <div class="row d-none" id="savecancelbtndiv{{$defaulttask->id}}">
                                    {{-- Save Button --}}
                                    <div class="col-auto mt-1 pe-2">
                                        <button class="btn btn-primary w-100 th-orange t-gray border border-2 bc-orange fw-bold" type="submit" id="defaulttasksavebtn{{$defaulttask->id}}">@lang('home.news.create.save')</button>
                                    </div>
                                    {{-- Cancel Button --}}
                                    <div class="col-auto mt-1 ps-0">
                                        <button class="btn btn-primary w-100 t-orange border border-2 bc-orange bg-transparent" type="reset" id="defaulttaskcancelbtn{{$defaulttask->id}}" onclick="hideDefaulttaskEdit('{{$devicetypes[$defaulttask->device_type]}}', {{$key}}, {{$defaulttask->id}})">@lang('home.news.create.cancel')</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    @endforeach
                    @endempty
                    <div class="row">
                        {{-- Add Default Task --}}
                        <div class="container-fluid ps-4">
                            <div class="row pe-0">
                                <button class="text-start p-0 bg-transparent border-0" onclick="showAddDefaultTaskForm()" id="adddefaulttaskbtn">
                                    <div class="ms-0 rounded-2 p-1 mb-2 border border-2 bc-orange" id="adddefaulttask">
                                        <h5 class="my-auto t-orange">+ @lang('admin.adddefaulttask')</h5>
                                    </div>
                                </button>
                            </div>
                            <form class="row pe-0 d-none" method="POST" action="{{ route('default_task.store') }}" id="adddefaulttaskform">
                                @csrf
                                {{-- Device Type --}}
                                <hr class="mb-2">
                                <div class="row text-start">
                                    <div class="row mb-1">
                                        <div class="col ps-0">
                                            <h5 class="mb-1 fs-5">@lang('admin.devicetype'):</h5>
                                        </div>
                                    </div>
                                    <div class="row pe-0 mb-3">
                                        @foreach ($devicetypes as $key => $devicetype)

                                            <div class="col-auto rounded rounded-2 py-1 ps-1 me-1 border border-2 bc-lightgray" id="adddefaulttaskradio">
                                                <input class="form-check-input" type="radio" name="device_type" value="{{$key}}" id="{{ $key }}" @if (isset($defaulttask) && ($key == $defaulttask->device_type)) checked @endif>
                                                <label class="form-check-label" for="{{ $key }}">{{$devicetype}}</label>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                                <textarea class="w-100 rounded-2 ps-2 pt-1 mb-2 th-lightergray t-white border-0 i-outline-none i-resize-none" name="text" id="text" rows="6"></textarea>
                                <div class="row mb-2">
                                    <input class="col-auto rounded-1 me-2 th-orange t-gray fw-bold border-0" type="submit" title="{{ __('home.news.create.save') }}" value="{{ __('home.news.create.save') }}" id="adddefaulttasksavebtn">
                                    <input class="col-auto rounded-1 t-orange border border-2 bc-orange bg-transparent" type="reset" title="{{ __('home.news.create.cancel') }}" value="{{ __('home.news.create.cancel') }}" onclick="hideAddDefaultTaskForm()" id="adddefaulttaskcancelbtn">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Workshops --}}
            <div class="row th-gray rounded-3 pt-2" id="workshops">
                <h3>@lang('sidebar.workshops')</h3>
                <div class="row pe-0 me-0 pb-1" id="workshopdiv">
                    {{-- Workshops --}}
                    @foreach ($workshops as $workshop)

                        {{-- Delete Workshop Form --}}
                        <form method="POST" action="{{ route('workshop.destroy', $workshop) }}" id="workshopdestroy{{$workshop->id}}">
                            @csrf
                            @method('DELETE')
                        </form>
                        {{-- Edit Workshop Form --}}
                        <form action="{{ route('workshop.update', $workshop) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-2">
                                <div class="row">
                                    {{-- Name --}}
                                    <div class="col-3">
                                        <input class="rounded-2 w-100 h-100 p-1 workshopname border border-2 bc-lightgray bg-transparent t-white fs-5 i-outline-none scssname" type="text" name="name" id="workshopname{{$workshop->id}}" value="{{ $workshop->name }}" disabled>
                                    </div>
                                    {{-- Address --}}
                                    <div class="col ps-0">
                                        <input class="rounded-2 w-100 h-100 p-1 workshopaddress border border-2 bc-lightgray bg-transparent t-white fs-5 i-outline-none scssaddress" type="text" name="address" id="workshopaddress{{$workshop->id}}" value="{{ $workshop->address }}" disabled>
                                    </div>
                                    {{-- Edit Button --}}
                                    <div class="col-auto me-2 p-0">
                                        <button class="btn btn-primary m-0 h-100 border border-2 bc-orange bg-transparent t-orange" type="button" onclick="showWorkshopEdit({{$workshop->id}})" id="workshopedit{{$workshop->id}}">
                                            <img class="img-w-20" src="{{ asset('/img/icons/pen.svg') }}" alt="@lang('admin.edit')">
                                        </button>
                                    </div>
                                    {{-- Delete Button --}}
                                    <div class="col-auto rounded-2 p-0">
                                        <button class="btn btn-primary m-0 h-100 border border-2 bc-orange th-orange t-orange" type="button" name="workshopdelete" onclick="changeModalSubmitButton('workshopdestroy{{$workshop->id}}'), changeModalText('@lang('delete.sure.workshop')')" data-bs-toggle="modal" data-bs-target="#deletemodal">
                                            <img class="img-w-20" src="{{ asset('/img/icons/gray/minus-solid.svg') }}" alt="@lang('admin.delete')">
                                        </button>
                                    </div>
                                </div>
                                {{-- Save Button --}}
                                <div class="row d-none" id="workshopeditbtnsdiv{{$workshop->id}}">
                                    <div class="col-auto mt-1 pe-2">
                                        <button class="btn btn-primary w-100 th-orange t-gray border border-2 bc-orange fw-bold" type="submit" id="workshopsavebtn{{$workshop->id}}" name="workshopsavebtn">@lang('home.news.create.save')</button>
                                    </div>
                                    <div class="col-auto mt-1 ps-0">
                                        <button class="btn btn-primary w-100 t-orange border border-2 bc-orange bg-transparent" type="reset" id="workshopcancelbtn{{$workshop->id}}" onclick="hideWorkshopEdit({{$workshop->id}})">@lang('home.news.create.cancel')</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    @endforeach
                    <div class="row">
                        {{-- Add Workshop --}}
                        <div class="container-fluid ps-4">
                            <div class="row pe-0">
                                <button class="text-start p-0 bg-transparent border-0" onclick="showAddWorkshopForm()" id="addworkshopbtn">
                                    <div class="ms-0 rounded-2 p-1 mb-2 border border-2 bc-orange t-orange" id="addworkshop">
                                        <h5 class="my-auto">+ @lang('admin.addworkshop')</h5>
                                    </div>
                                </button>
                            </div>
                            <form class="row pe-0 d-none" method="POST" action="{{ route('workshop.store') }}" id="addworkshopform">
                                @csrf
                                <hr class="mb-2">
                                <div class="row pe-0">
                                    <label class="col-1 fs-5" for="name">@lang('profile.label.name'):</label>
                                    <input class="col rounded-2 ps-2 pt-1 mb-2 th-lightergray t-white border-0 i-outline-none" type="text" name="name" value="" />
                                </div>
                                <div class="row pe-0">
                                    <label class="col-1 fs-5" for="name">@lang('admin.address'):</label>
                                    <input class="col rounded-2 ps-2 pt-1 mb-2 th-lightergray t-white border-0 i-outline-none" type="text" name="address" value="" />
                                </div>
                                <div class="row mb-2 ps-4">
                                    <input class="col-auto rounded-1 me-2 th-orange t-gray fw-bold border-0" type="submit" title="{{ __('home.news.create.save') }}" value="{{ __('home.news.create.save') }}" id="addworkshopsavebtn">
                                    <input class="col-auto rounded-1 border border-2 bc-orange t-orange bg-transparent" type="reset" title="{{ __('home.news.create.cancel') }}" value="{{ __('home.news.create.cancel') }}" onclick="hideAddWorkshopForm()" id="addworkshopcancelbtn">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Confirm delete modal --}}
            <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="deletemodallabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content th-gray">
                        {{-- Confirm delete Modal Header --}}
                        <div class="modal-header bc-lightergray" id="deletemodalheader">
                            <h1 class="modal-title fs-4" id="deletemodallabel">@lang('home.news.deletearticle')</h1>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" id="deletemodalclosex"></button>
                        </div>
                        {{-- Confirm delete Modal Body --}}
                        <div class="modal-body" id="deletemodalbody">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col">
                                        <p class="mb-0 fs-5" id="deletemodaltext"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Confirm delete Modal Footer --}}
                        <div class="modal-footer bc-lightergray" id="deletemodalfooter">
                            <button type="submit" class="btn btn-primary th-orange bc-orange t-gray fw-bold border border-2" id="deletemodalbtn" form="newsdestroy">@lang('home.news.delete')</button>
                            <button type="button" class="btn btn-secondary border border-2 bc-orange t-orange bg-transparent" data-bs-dismiss="modal" id="deletemodalclosebtn">@lang('home.news.create.cancel')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
