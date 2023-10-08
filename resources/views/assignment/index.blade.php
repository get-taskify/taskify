@extends('layouts.app')

@section('title', __('sidebar.assignments'))

@section('content')

    <div id="assignments">
        {{-- Title --}}
        <h1 class="text-capitalize t-orange fw-bold">@lang('sidebar.assignments')</h1>
        <div class="container-fluid">
            {{-- Filter --}}
            <div class="row mb-3 px-2" id="assignmentfilter">
                <div class="col rounded-3 th-gray p-3">
                    <form class="container-fluid ps-0" method="GET" id="assignmentfilterform">
                        @csrf
                        @method('GET')
                        <div class="row">
                            {{-- Workshop --}}
                            <div class="col-3 fs-5 mb-2" id="assignmentfilterdropdown">
                                <label for="workshop">@lang('assignment.workshop')</label>
                                <br />
                                <div class="dropdown rounded-2" id="dropdowndiv">
                                    <button class="btn btn-secondary dropdown-toggle text-start w-100 border border-2 bc-lightgray bg-transparent t-white fs-5" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="assignmentfilterworkshopbtn">
                                        @if (isset($filter['workshop']) && $filter['workshop'] != 0)

                                            {{$workshops[$filter['workshop']]->name}}

                                        @else

                                            @lang('assignment.all')

                                        @endif
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark shadow w-100 py-0 th-lightergray" id="dropdownul">
                                        <li class="ps-2 border-bottom border-2 bc-lightgray" id="dropdownitemdiv">
                                            <input class="form-check-input" type="radio" name="workshop" value="" id="workshopradio0" @if (isset($filter['workshop']) && $filter['workshop'] == 0 || !isset($filter['workshop'])) checked @endif hidden>
                                            <label class="form-check-label fs-5 w-100 t-white" for="workshopradio0" onclick="changeWorkshopdropdownbtnValue(0, '@lang('assignment.all')')">@lang('assignment.all')</label>
                                        </li>
                                        @foreach ($workshops as $key => $workshop)

                                            <li class="ps-2 border-bottom border-2 bc-lightgray" id="dropdownitemdiv">
                                                <input class="form-check-input" type="radio" name="workshop" value="{{$workshop->id }}" id="workshopradio{{ $workshop->id }}" @if (isset($filter['workshop']) && $filter['workshop'] == $workshop->id) checked @endif hidden>
                                                <label class="form-check-label fs-5 w-100 t-white" for="workshopradio{{ $workshop->id }}" onclick="changeWorkshopdropdownbtnValue({{ $workshop->id }}, '{{ $workshop->name }}')">{{$workshop->name}}</label>
                                            </li>

                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            {{-- State --}}
                            <div class="col-3 fs-5 mb-2" id="assignmentfilterdropdown">
                                <label for="state">@lang('assignment.state')</label>
                                <br />
                                <div class="dropdown rounded-2" id="dropdowndiv">
                                    <button class="btn btn-secondary dropdown-toggle text-start w-100 border border-2 bc-lightgray bg-transparent t-white fs-5" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="assignmentfilterstatebtn">
                                        @if (isset($filter['state']) && $filter['state'] != 0)

                                            {{$states[$filter['state']]}}

                                        @else

                                            @lang('assignment.all')

                                        @endif
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark shadow w-100 py-0 th-lightergray" id="dropdownul">
                                        <li class="ps-2 border-bottom border-2 bc-lightgray" id="dropdownitemdiv">
                                            <input class="form-check-input" type="radio" name="state" value="" id="stateradio0" @if (isset($filter['state']) && $filter['state'] == 0 || !isset($filter['state'])) checked @endif hidden>
                                            <label class="form-check-label fs-5 w-100 t-white" for="stateradio0" onclick="changeStatedropdownbtnValue(0, '@lang('assignment.all')')">@lang('assignment.all')</label>
                                        </li>
                                        @foreach ($states as $key => $state)

                                            <li class="ps-2 border-bottom border-2 bc-lightgray" id="dropdownitemdiv">
                                                <input class="form-check-input" type="radio" name="state" value="{{ $key }}" id="stateradio{{ $key }}" @if (isset($filter['state']) && $filter['state'] == $key) checked @endif hidden>
                                                <label class="form-check-label fs-5 w-100 t-white" for="stateradio{{ $key }}" onclick="changeStatedropdownbtnValue({{ $key }}, '{{ $state }}')">{{$state}}</label>
                                            </li>

                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            {{-- Priority --}}
                            <div class="col-3 fs-5 mb-2" id="assignmentfilterdropdown">
                                <label for="priority">@lang('assignment.priority')</label>
                                <br />
                                <div class="dropdown rounded-2" id="dropdowndiv">
                                    <button class="btn btn-secondary dropdown-toggle text-start w-100 border border-2 bc-lightgray bg-transparent t-white fs-5" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="assignmentfilterprioritybtn">
                                        @if (isset($filter['priority']) && $filter['priority'] != 0)

                                            {{$priorities[$filter['priority']]}}

                                        @else

                                            @lang('assignment.all')

                                        @endif
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark shadow w-100 py-0 th-lightergray" id="dropdownul">
                                        <li class="ps-2 border-bottom border-2 bc-lightgray" id="dropdownitemdiv">
                                            <input class="form-check-input" type="radio" name="priority" value="" id="priorityradio0" @if (isset($filter['priority']) && $filter['priority'] == 0 || !isset($filter['priority'])) checked @endif hidden>
                                            <label class="form-check-label fs-5 w-100 t-white" for="priorityradio0" onclick="changePrioritydropdownbtnValue(0, '@lang('assignment.all')')">@lang('assignment.all')</label>
                                        </li>
                                        @foreach ($priorities as $key => $priority)

                                            <li class="ps-2 border-bottom border-2 bc-lightgray" id="dropdownitemdiv">
                                                <input class="form-check-input" type="radio" name="priority" value="{{ $key }}" id="priorityradio{{ $key }}" @if (isset($filter['priority']) && $filter['priority'] == $key) checked @endif hidden>
                                                <label class="form-check-label fs-5 w-100 t-white" for="priorityradio{{ $key }}" onclick="changePrioritydropdownbtnValue({{ $key }}, '{{ $priority }}')">{{ $priority }}</label>
                                            </li>

                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            {{-- Pc Type --}}
                            <div class="col-3 fs-5 mb-2" id="assignmentfilterdropdown">
                                <label for="pctype">@lang('assignment.pctype')</label>
                                <br />
                                <div class="dropdown rounded-2" id="dropdowndiv">
                                    <button class="btn btn-secondary dropdown-toggle text-start w-100 border border-2 bc-lightgray bg-transparent t-white fs-5" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="assignmentfilterpctypebtn">
                                        @if (isset($filter['pctype']) && $filter['pctype'] != 0)

                                            {{$pctypes[$filter['pctype']]}}

                                        @else

                                            @lang('assignment.all')

                                        @endif
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark shadow w-100 py-0 th-lightergray" id="dropdownul">
                                        <li class="ps-2 border-bottom border-2 bc-lightgray" id="dropdownitemdiv">
                                            <input class="form-check-input" type="radio" name="pctype" value="" id="pctyperadio0" @if (isset($filter['pctype']) && $filter['pctype'] == 0 || !isset($filter['pctype'])) checked @endif hidden>
                                            <label class="form-check-label fs-5 w-100 t-white" for="pctyperadio0" onclick="changePctypedropdownbtnValue(0, '@lang('assignment.all')')">@lang('assignment.all')</label>
                                        </li>
                                        @foreach ($pctypes as $key => $pctype)

                                            <li class="ps-2 border-bottom border-2 bc-lightgray" id="dropdownitemdiv">
                                                <input class="form-check-input" type="radio" name="pctype" value="{{ $key }}" id="pctyperadio{{ $key }}" @if (isset($filter['pctype']) && $filter['pctype'] == $key) checked @endif hidden>
                                                <label class="form-check-label fs-5 w-100 t-white" for="pctyperadio{{ $key }}" onclick="changePctypedropdownbtnValue({{ $key }}, '{{ $pctype }}')">{{ $pctype }}</label>
                                            </li>

                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            {{-- System Language --}}
                            <div class="col-3 fs-5" id="assignmentfilterdropdown">
                                <label for="systemlanguage">@lang('assignment.systemlanguage')</label>
                                <br />
                                <div class="dropdown rounded-2" id="dropdowndiv">
                                    <button class="btn btn-secondary dropdown-toggle text-start w-100 border border-2 bc-lightgray bg-transparent t-white fs-5" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="assignmentfiltersystemlanguagebtn">
                                        @if (isset($filter['systemlanguage']) && $filter['systemlanguage'] != 0)

                                            {{$systemlanguages[$filter['systemlanguage']]}}

                                        @else

                                            @lang('assignment.all')

                                        @endif
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark shadow w-100 py-0 th-lightergray" id="dropdownul">
                                        <li class="ps-2 border-bottom border-2 bc-lightgray" id="dropdownitemdiv">
                                            <input class="form-check-input" type="radio" name="systemlanguage" value="" id="systemlanguageradio0" @if (isset($filter['systemlanguage']) && $filter['systemlanguage'] == 0 || !isset($filter['systemlanguage'])) checked @endif hidden>
                                            <label class="form-check-label fs-5 w-100 t-white" for="systemlanguageradio0" onclick="changeSystemlanguagedropdownbtnValue(0, '@lang('assignment.all')')">@lang('assignment.all')</label>
                                        </li>
                                        @foreach ($systemlanguages as $key => $systemlanguage)

                                            <li class="ps-2 border-bottom border-2 bc-lightgray" id="dropdownitemdiv">
                                                <input class="form-check-input" type="radio" name="systemlanguage" value="{{ $key }}" id="systemlanguageradio{{ $key }}" @if (isset($filter['systemlanguage']) && $filter['systemlanguage'] == $key) checked @endif hidden>
                                                <label class="form-check-label fs-5 w-100 t-white" for="systemlanguageradio{{ $key }}" onclick="changeSystemlanguagedropdownbtnValue({{ $key }}, '{{ $systemlanguage }}')">{{ $systemlanguage }}</label>
                                            </li>

                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row text-end">
                            {{-- Hidden Search Field --}}
                            @if (isset($filter['search']))

                                <input type="text" name="search" value="{{ $filter['search'] }}" hidden>

                            @endif

                            {{-- Save Button --}}
                            <input class="col-auto rounded-2 ms-auto th-orange t-gray border-0 fs-4 fw-bold" name="assignmentfilter" type="submit" title="{{ __('assignment.filter') }}" value="{{ __('assignment.filter') }}" id="assignmentfilterbtn">
                        </div>
                    </form>
                </div>
            </div>
            {{-- Assignments --}}
            <div class="row">
                @foreach ($assignments as $assignment)

                    <div class="col-3 px-2 mb-3">
                        <a class="text-decoration-none" href="{{ URL::route('assignment.show', $assignment) }}">
                            <div class="container-fluid th-gray rounded-4 p-3">
                                {{-- Image --}}
                                <div class="row m-0 mb-2">
                                    <div class="col th-lightergray rounded-3 p-4 text-center">
                                        <img id="assignmentimg" src="{{ asset('img/icons/lightgray/clipboard-list.svg') }}" alt="{{ __('sidebar.assignments') }}">
                                    </div>
                                </div>
                                {{-- Name --}}
                                <div class="row m-0 mb-2">
                                    <h5 class="col t-white fs-4 ps-1">{{$assignment->name}}</h5>
                                </div>
                                <div class="row m-0 t-whitegray text-center mb-2 h-100 fs-5">
                                    {{-- Workshop --}}
                                    <p class="text-start mb-0 fs-5">@lang('assignment.workshop')</p>
                                    <div class="col rounded-2 th-lightergray">
                                        <p class="my-2">{{$assignment->workshop}}</p>
                                    </div>
                                </div>
                                <div class="row m-0 t-whitegray text-center mb-2 h-100 fs-5">
                                    {{-- State --}}
                                    <div class="col me-2">
                                        <p class="text-start mb-0 fs-5">@lang('assignment.state')</p>
                                        <div class="row rounded-2 th-lightergray">
                                            <p class="my-2">{{$assignment->state_name}}</p>
                                        </div>
                                    </div>
                                    {{-- Priority --}}
                                    <div class="col">
                                        <p class="text-start mb-0 fs-5">@lang('assignment.priority')</p>
                                        <div class="row rounded-2 th-lightergray">
                                            <p class="my-2">{{$assignment->priority_name}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0 t-whitegray text-center mb-2 h-100 fs-5">
                                    {{-- System Language --}}
                                    <div class="col me-2">
                                        <p class="text-start mb-0 fs-5">@lang('assignment.systemlanguage')</p>
                                        <div class="row rounded-2 th-lightergray">
                                            <p class="my-2">{{$assignment->system_language}}</p>
                                        </div>
                                    </div>
                                    {{-- PC Type --}}
                                    <div class="col">
                                        <p class="text-start mb-0 fs-5">@lang('assignment.pctype')</p>
                                        <div class="row rounded-2 th-lightergray">
                                            <p class="my-2">{{$assignment->pc_type}}</p>
                                        </div>
                                    </div>
                                </div>
                                {{-- Task Count --}}
                                <div class="row m-0 t-orange fs-4 fw-bold text-end">
                                    <div class="col pe-1">
                                        <p class="m-0">{{$assignment->tasks['notfinished']}}/{{$assignment->tasks['finished']}}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                @endforeach
            </div>
        </div>
    </div>

@endsection
