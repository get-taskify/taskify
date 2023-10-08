@extends('layouts.app')

@section('title', __('sidebar.editassignment'))

@section('content')

    <div id="createassignment">
        <h1 class="text-capitalize t-orange fw-bold">@lang('sidebar.editassignment') - {{ $assignment->name }}</h1>
        <div class="container-fluid rounded-3 th-gray pt-2 pb-3">
            {{-- Delete Assignment Form --}}
            <form method="POST" action="{{ route('assignment.destroy', $assignment) }}" id="assignmentdestroy">
                @csrf
                @method('DELETE')
            </form>
            <form action="{{ route('assignment.update', $assignment) }}" method="POST">
                @csrf
                @method('PUT')
                {{-- Name --}}
                <div class="row">
                    <div class="col-3 mb-3">
                        <label class="t-white fs-5" for="name">@lang('profile.label.name')</label>
                        <br />
                        <input class="rounded-2 ps-2 w-100 py-1 bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5" type="text" name="name" placeholder="@lang('profile.label.name')" value="{{ $assignment->name }}" required />
                    </div>
                </div>
                <div class="row">
                    {{-- System Language --}}
                    <div class="col-3 mb-3">
                        <label class="t-white fs-5" for="system_language">@lang('assignment.systemlanguage')</label>
                        <br />
                        <div class="dropdown rounded-2" id="dropdowndiv">
                            <button class="btn btn-secondary dropdown-toggle text-start w-100 border border-2 bc-lightgray bg-transparent t-white fs-5" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="createassignmentsystemlanguagebtn">
                                {{ $systemlanguages[$pc->system_language] }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark shadow w-100 py-0 th-lightergray" id="dropdownul">
                                @foreach ($systemlanguages as $key => $systemlanguage)

                                    <li class="ps-2 border-bottom border-2 bc-lightgray" id="dropdownitemdiv">
                                        <input class="form-check-input bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5" type="radio" name="system_language" value="{{$key }}" id="systemLanguageradio{{ $key }}" @if ($key == $pc->system_language) checked @endif hidden>
                                        <label class="form-check-label fs-5 w-100 t-white" for="system_language{{ $key }}" onclick="changeCreateSLdropdownbtnValue({{ $key }}, '{{ $systemlanguage }}')">{{$systemlanguage}}</label>
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
                                        <input class="form-check-input bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5" type="radio" name="workshop_id" value="{{ $workshop->id }}" id="workshopradio{{ $workshop->id }}" @if ($workshop->id == $assignment->workshop_id) checked @endif hidden>
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
                        <input class="rounded-2 ps-2 w-100 py-1 bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5" type="text" name="brand" placeholder="@lang('assignment.brand')" value="{{ $pc->brand }}" required />
                    </div>
                    {{-- CPU --}}
                    <div class="col-3 mb-3">
                        <label class="t-white fs-5" for="cpu">@lang('assignment.cpu')</label>
                        <br />
                        <input class="rounded-2 ps-2 w-100 py-1 bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5" type="text" name="cpu" placeholder="@lang('assignment.cpu')" value="{{ $pc->cpu }}" required />
                    </div>
                    {{-- RAM --}}
                    <div class="col-3 mb-3">
                        <label class="t-white fs-5" for="ram">@lang('assignment.ram')</label>
                        <br />
                        <input class="rounded-2 ps-2 w-100 py-1 bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5" type="number" name="ram" placeholder="0" value="{{ $pc->ram }}" required />
                    </div>
                    {{-- Storage --}}
                    <div class="col-3 mb-3">
                        <label class="t-white fs-5" for="storage">@lang('assignment.storage')</label>
                        <br />
                        <input class="rounded-2 ps-2 w-100 py-1 bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5" type="number" name="storage" placeholder="0" value="{{ $pc->storage }}" required />
                    </div>
                </div>
                <div class="row">
                    {{-- Architecture --}}
                    <div class="col-3 mb-3">
                        <label class="t-white fs-5" for="architecture">@lang('assignment.architecture')</label>
                        <br />
                        <input class="rounded-2 ps-2 w-100 py-1 bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5" type="text" name="architecture" placeholder="@lang('assignment.architecture')" value="{{ $pc->architecture }}" required />
                    </div>
                    {{-- BIOS Key --}}
                    <div class="col-3 mb-3">
                        <label class="t-white fs-5" for="biosKey">@lang('assignment.bioskey')</label>
                        <br />
                        <input class="rounded-2 ps-2 w-100 py-1 bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5" type="text" name="bios_key" placeholder="@lang('assignment.bioskey')" value="{{ $pc->bios_key }}" required />
                    </div>
                    {{-- PC Type --}}
                    <div class="col-3 mb-3">
                        <label class="t-white fs-5" for="pcType">@lang('assignment.pctype')</label>
                        <br />
                        <div class="dropdown rounded-2" id="dropdowndiv">
                            <button class="btn btn-secondary dropdown-toggle text-start w-100 border border-2 bc-lightgray bg-transparent t-white fs-5" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="createassignmentpcTypebtn">
                                {{ $pctypes[$pc->pc_type] }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark shadow w-100 py-0 th-lightergray" id="dropdownul">
                                @foreach ($pctypes as $key => $pctype)

                                    <li class="ps-2 border-bottom border-2 bc-lightgray" id="dropdownitemdiv">
                                        <input class="form-check-input bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5" type="radio" name="pc_type" value="{{ $key }}" id="pcTyperadio{{ $key }}" @if ($key == $pc->pc_type) checked @endif hidden>
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
                                {{ $priorities[$assignment->priority] }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark shadow w-100 py-0 th-lightergray" id="dropdownul">
                                @foreach ($priorities as $key => $priority)

                                    <li class="ps-2 border-bottom border-2 bc-lightgray" id="dropdownitemdiv">
                                        <input class="form-check-input bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5" type="radio" name="priority" value="{{ $key }}" id="priorityradio{{ $key }}" @if ($key == $assignment->priority) checked @endif hidden>
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
                                {{ $states[$assignment->state] }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark shadow w-100 py-0 th-lightergray" id="dropdownul">
                                @foreach ($states as $key => $state)

                                    <li class="ps-2 border-bottom border-2 bc-lightgray" id="dropdownitemdiv">
                                        <input class="form-check-input bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5" type="radio" name="state" value="{{ $key }}" id="stateradio{{ $key }}" @if ($key == $assignment->state) checked @endif hidden>
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
                        {{-- Tasks --}}
                        @foreach ($tasks as $task)

                            <div class="row" id="task-{{ $task->id }}">
                                <div class="col-3 mb-3">
                                    <input class="rounded-2 ps-2 w-100 py-1 bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5" type="text" name="updatetasks[{{ $task->id }}]" value="{{ $task->text }}">
                                </div>
                                {{-- Delete Button --}}
                                <div class="col-auto rounded-2 p-0">
                                    <button class="btn btn-primary m-0 bc-orange th-orange" type="button" id="createassignmentdeletetaskbtn" name="createassignmentdeletetaskbtn" onclick="addHiddenTaskField({{ $task->id }}); deleteTask({{ $task->id }})">
                                        <img src="{{ asset('/img/icons/gray/minus-solid.svg') }}" alt="@lang('admin.delete')">
                                    </button>
                                </div>
                                <br>
                            </div>

                        @endforeach
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
                        <textarea class="rounded-2 ps-2 w-100 py-1 bg-transparent i-outline-none border border-2 bc-lightgray t-white fs-5" name="notes" id="notes" cols="30" rows="10" placeholder="@lang('assignment.additionalnotes')">@isset($note->text){{ $note->text }}@endisset</textarea>
                    </div>
                </div>
                <div class="row">
                    {{-- Save Button --}}
                    <div class="col-1">
                        <button class="btn btn-primary th-orange w-100 t-gray border border-2 bc-orange fw-bold fs-5" type="submit" id="createassignmentsavebtn">@lang('home.news.create.save')</button>
                    </div>
                    {{-- Cancel Button --}}
                    <div class="col-auto p-0">
                        <a class="btn btn-primary w-100 bg-transparent border border-2 bc-orange t-orange fw-bold fs-5" id="cancelbtn" href="{{ URL::route('assignment.show', $assignment) }}">
                            @lang('home.news.create.cancel')
                       </a>
                    </div>
                    {{-- Delete Button --}}
                    <div class="col-auto">
                        <button class="btn btn-primary th-gray w-100 border border-2 bc-orange t-orange fw-bold fs-5" type="button" data-bs-toggle="modal" data-bs-target="#deletemodal">
                            {{ __('home.news.delete') }}
                        </button>
                    </div>
                </div>
                <input type="number" value="{{$assignment->repair_object_id}}" name="repair_object_id" hidden />
            </form>
            {{-- Confirm delete modal --}}
            <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="deletemodallabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content th-gray">
                        {{-- Confirm delete Modal Header --}}
                        <div class="modal-header bc-lightergray" id="deletemodalheader">
                            <h1 class="modal-title fs-4" id="deletemodallabel">@lang('home.news.delete') @lang('assignment.assignment')</h1>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" id="deletemodalclosex"></button>
                        </div>
                        {{-- Confirm delete Modal Body --}}
                        <div class="modal-body" id="deletemodalbody">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col">
                                        <p class="mb-0 fs-5" id="deletemodaltext">@lang('delete.sure.assignment')</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Confirm delete Modal Footer --}}
                        <div class="modal-footer bc-lightergray" id="deletemodalfooter">
                            <button type="submit" class="btn btn-primary th-orange bc-orange t-gray fw-bold border border-2" id="deletemodalbtn" form="assignmentdestroy">@lang('home.news.delete')</button>
                            <button type="button" class="btn btn-secondary border border-2 bc-orange t-orange bg-transparent" data-bs-dismiss="modal" id="deletemodalclosebtn">@lang('home.news.create.cancel')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
