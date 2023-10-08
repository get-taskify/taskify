@extends('layouts.app')

@section('title', __('sidebar.createassignment'))

@section('content')

    <div id="createassignment">
        <h1 class="text-capitalize t-orange fw-bold">@lang('sidebar.createassignment')</h1>
        <div class="container-fluid rounded-3 th-gray pt-2 pb-3">
            <form action="{{ route('assignment.store') }}" method="POST">
                @csrf
                {{-- Name --}}
                <div class="row">
                    <div class="col-3 mb-3">
                        <label class="t-white fs-5" for="name">@lang('profile.label.name')</label>
                        <br />
                        <input class="rounded-2 ps-2 w-100 py-1 bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5" type="text" name="name" placeholder="@lang('profile.label.name')" required />
                    </div>
                </div>
                <div class="row">
                    {{-- System Language --}}
                    <div class="col-3 mb-3">
                        <label class="t-white fs-5" for="systemLanguage">@lang('assignment.systemlanguage')</label>
                        <br />
                        <div class="dropdown rounded-2" id="dropdowndiv">
                            <button class="btn btn-secondary dropdown-toggle text-start w-100 border border-2 bc-lightgray bg-transparent t-white fs-5" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="createassignmentsystemlanguagebtn">
                                {{ $systemlanguages[1] }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark shadow w-100 py-0 th-lightergray" id="dropdownul">
                                @foreach ($systemlanguages as $key => $systemlanguage)

                                    <li class="ps-2 border-bottom border-2 bc-lightgray" id="dropdownitemdiv">
                                        <input class="form-check-input" type="radio" name="systemLanguage" value="{{$key }}" id="systemLanguageradio{{ $key }}" @if ($key == 1) checked @endif hidden>
                                        <label class="form-check-label fs-5 w-100 t-white" for="systemLanguage{{ $key }}" onclick="changeCreateSLdropdownbtnValue({{ $key }}, '{{ $systemlanguage }}')">{{$systemlanguage}}</label>
                                    </li>

                                @endforeach
                            </ul>
                        </div>
                    </div>
                    {{-- Workshop --}}
                    <div class="col-3 mb-3">
                        <label class="t-white fs-5" for="workshop">@lang('assignment.workshop')</label>
                        <br />
                        <div class="dropdown rounded-2" id="dropdowndiv">
                            <button class="btn btn-secondary dropdown-toggle text-start w-100 border border-2 bc-lightgray bg-transparent t-white fs-5" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="assignmentfilterworkshopbtn">
                                {{ $workshops[0]->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark shadow w-100 py-0 th-lightergray" id="dropdownul">
                                @foreach ($workshops as $key => $workshop)

                                    <li class="ps-2 border-bottom border-2 bc-lightgray" id="dropdownitemdiv">
                                        <input class="form-check-input" type="radio" name="workshop" value="{{ $workshop->id }}" id="workshopradio{{ $workshop->id }}" @if ($workshop->id == $workshops[0]->id) checked @endif hidden>
                                        <label class="form-check-label fs-5 w-100 t-white" for="workshopradio{{ $workshop->id }}" onclick="changeWorkshopdropdownbtnValue({{ $workshop->id }}, '{{ $workshop->name }}')">{{$workshop->name}}</label>
                                    </li>

                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- Brand --}}
                    <div class="col-3 mb-3">
                        <label class="t-white fs-5" for="brand">@lang('assignment.brand')</label>
                        <br />
                        <input class="rounded-2 ps-2 w-100 py-1 bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5" type="text" name="brand" placeholder="@lang('assignment.brand')" required />
                    </div>
                    {{-- CPU --}}
                    <div class="col-3 mb-3">
                        <label class="t-white fs-5" for="cpu">@lang('assignment.cpu')</label>
                        <br />
                        <input class="rounded-2 ps-2 w-100 py-1 bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5" type="text" name="cpu" placeholder="@lang('assignment.cpu')" required />
                    </div>
                    {{-- RAM --}}
                    <div class="col-3 mb-3">
                        <label class="t-white fs-5" for="ram">@lang('assignment.ram') [GB]</label>
                        <br />
                        <input class="rounded-2 ps-2 w-100 py-1 bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5 input-arrows-none" type="number" min="0" name="ram" placeholder="0" required />
                    </div>
                    {{-- Storage --}}
                    <div class="col-3 mb-3">
                        <label class="t-white fs-5" for="storage">@lang('assignment.storage') [GB]</label>
                        <br />
                        <input class="rounded-2 ps-2 w-100 py-1 bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5 input-arrows-none" type="number" min="0" name="storage" placeholder="0" required />
                    </div>
                </div>
                <div class="row">
                    {{-- Architecture --}}
                    <div class="col-3 mb-3">
                        <label class="t-white fs-5" for="architecture">@lang('assignment.architecture')</label>
                        <br />
                        <input class="rounded-2 ps-2 w-100 py-1 bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5" type="text" name="architecture" placeholder="@lang('assignment.architecture')" required />
                    </div>
                    {{-- BIOS Key --}}
                    <div class="col-3 mb-3">
                        <label class="t-white fs-5" for="biosKey">@lang('assignment.bioskey')</label>
                        <br />
                        <input class="rounded-2 ps-2 w-100 py-1 bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5" type="text" name="biosKey" placeholder="@lang('assignment.bioskey')" required />
                    </div>
                    {{-- PC Type --}}
                    <div class="col-3 mb-3">
                        <label class="t-white fs-5" for="pcType">@lang('assignment.pctype')</label>
                        <br />
                        <div class="dropdown rounded-2" id="dropdowndiv">
                            <button class="btn btn-secondary dropdown-toggle text-start w-100 border border-2 bc-lightgray bg-transparent t-white fs-5" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="createassignmentpcTypebtn">
                                {{ $pctypes[1] }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark shadow w-100 py-0 th-lightergray" id="dropdownul">
                                @foreach ($pctypes as $key => $pctype)

                                    <li class="ps-2 border-bottom border-2 bc-lightgray" id="dropdownitemdiv">
                                        <input class="form-check-input" type="radio" name="pcType" value="{{ $key }}" id="pcTyperadio{{ $key }}" @if ($key == 1) checked @endif hidden>
                                        <label class="form-check-label fs-5 w-100 t-white" for="pcTyperadio{{ $key }}" onclick="changeCreatePTdropdownbtnValue({{ $key }}, '{{ $pctype }}')">{{$pctype}}</label>
                                    </li>

                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- Priority --}}
                    <div class="col-3 mb-3">
                        <label class="t-white fs-5" for="priority">@lang('assignment.priority')</label>
                        <br />
                        <div class="dropdown rounded-2" id="dropdowndiv">
                            <button class="btn btn-secondary dropdown-toggle text-start w-100 border border-2 bc-lightgray bg-transparent t-white fs-5" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="assignmentfilterprioritybtn">
                                {{ $priorities[1] }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark shadow w-100 py-0 th-lightergray" id="dropdownul">
                                @foreach ($priorities as $key => $priority)

                                    <li class="ps-2 border-bottom border-2 bc-lightgray" id="dropdownitemdiv">
                                        <input class="form-check-input" type="radio" name="priority" value="{{ $key }}" id="priorityradio{{ $key }}" @if ($key == 1) checked @endif hidden>
                                        <label class="form-check-label fs-5 w-100 t-white" for="priorityradio{{ $key }}" onclick="changePrioritydropdownbtnValue({{ $key }}, '{{ $priority }}')">{{$priority}}</label>
                                    </li>

                                @endforeach
                            </ul>
                        </div>
                    </div>
                    {{-- State --}}
                    <div class="col-3 mb-3">
                        <label class="t-white fs-5" for="state">@lang('assignment.state')</label>
                        <br />
                        <div class="dropdown rounded-2" id="dropdowndiv">
                            <button class="btn btn-secondary dropdown-toggle text-start w-100 border border-2 bc-lightgray bg-transparent t-white fs-5" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="assignmentfilterstatebtn">
                                {{ $states[1] }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark shadow w-100 py-0 th-lightergray" id="dropdownul">
                                @foreach ($states as $key => $state)

                                    <li class="ps-2 border-bottom border-2 bc-lightgray" id="dropdownitemdiv">
                                        <input class="form-check-input" type="radio" name="state" value="{{ $key }}" id="stateradio{{ $key }}" @if ($key == 1) checked @endif hidden>
                                        <label class="form-check-label fs-5 w-100 t-white" for="stateradio{{ $key }}" onclick="changeStatedropdownbtnValue({{ $key }}, '{{ $state }}')">{{$state}}</label>
                                    </li>

                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- Tasks --}}
                <div class="row">
                    <label class="t-white fs-5" for="tasks">@lang('assignment.tasks')</label>
                    <br />
                    <div class="container-fluid">
                        {{-- Default Tasks --}}
                        @foreach ($defaulttasks as $defaulttask)
                            <div class="row">
                                <div class="col-3 mb-3">
                                    <input class="rounded-2 ps-2 w-100 py-1 bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5" type="text" name="defaulttask" value="{{ $defaulttask->text }}" disabled>
                                    <input class="rounded-2 ps-2 w-100 py-1 bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5" type="text" name="defaulttasks[]" id="defaulttask-{{$defaulttask->id}}" value="{{ $defaulttask->id }}" hidden>
                                </div>
                                {{-- Delete Button --}}
                                <div class="col-auto rounded-2 p-0">
                                    <button class="btn btn-primary m-0 bc-orange th-orange" type="button" id="createassignmentdeletetaskbtn" name="createassignmentdeletetaskbtn" disabled>
                                        <img src="{{ asset('/img/icons/gray/minus-solid.svg') }}" alt="@lang('admin.delete')">
                                    </button>
                                </div>
                                <br>
                            </div>
                        @endforeach
                        {{-- Additional Tasks --}}
                        <div id="tasks">
                            {{-- Tasks inserted with JS --}}
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <a class="t-orange text-decoration-none fs-5" id="addtask" href="javascript:addTask()">+ @lang('assignment.addtask')</a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Additional Notes --}}
                <div class="row">
                    <div class="col-7 mb-3">
                        <label class="t-white fs-5" for="notes">@lang('assignment.additionalnotes')</label>
                        <br />
                        <textarea class="rounded-2 ps-2 w-100 py-1 bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5" name="notes" id="notes" cols="30" rows="10" placeholder="@lang('assignment.additionalnotes')"></textarea>
                    </div>
                </div>
                {{-- Save Button --}}
                <div class="row">
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary th-orange w-100 t-gray fw-bold border border-2 bc-orange fs-5" id="createassignmentsavebtn">@lang('home.news.create.save')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
