@extends('layouts.app')

@section('title', __('assignment.assignment') . ' - ' . $assignment->name)

@section('content')

    <div id="assignment">
        <h1 class="text-capitalize t-orange fw-bold">@lang('assignment.assignment')</h1>
        <div class="container-fluid ms-2">
            {{-- Assignment Name --}}
            <h3 class="fw-bold">{{$assignment->name}}</h3>
            {{-- Workshop - Priority - State --}}
            <p class="t-lightgray fs-5"><a class="t-lightgray text-decoration-none" href="{{ URL::Route('assignment.index', ['workshop' => $assignment->workshop->id]) }}">{{$assignment->workshop->name}}</a> - {{ $priority }} - {{ $state }} </p>
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col p-0">
                        <div class="container-fluid rounded-3 th-gray">
                            <div class="row text-center fs-5 p-3">
                                {{-- System Language --}}
                                <div class="col me-3 px-0">
                                    <h5 class="text-start mb-1">@lang('assignment.systemlanguage')</h5>
                                    <p class="t-lightgray rounded-2 th-lightergray py-2 mb-0">{{ $systemlanguage }}</p>
                                </div>
                                {{-- PC Type --}}
                                <div class="col px-0">
                                    <h5 class="text-start mb-1">@lang('assignment.pctype')</h5>
                                    <p class="t-lightgray rounded-2 th-lightergray py-2 mb-0">{{ $pctype }}</p>
                                </div>
                            </div>
                            <div class="row text-center fs-5 px-3">
                                {{-- CPU --}}
                                <div class="col me-3 px-0">
                                    <h5 class="text-start mb-1">@lang('assignment.cpu')</h5>
                                    <p class="t-lightgray rounded-2 th-lightergray py-2 mb-0">{{ $pc->cpu }}</p>
                                </div>
                                {{-- RAM --}}
                                <div class="col px-0">
                                    <h5 class="text-start mb-1">@lang('assignment.ram')</h5>
                                    <p class="t-lightgray rounded-2 th-lightergray py-2 mb-0">{{ $pc->ram }}</p>
                                </div>
                            </div>
                            <div class="row text-center fs-5 p-3">
                                {{-- Storage --}}
                                <div class="col me-3 px-0 mb-1">
                                    <h5 class="text-start">@lang('assignment.storage')</h5>
                                    <p class="t-lightgray rounded-2 th-lightergray py-2 mb-0">{{ $pc->storage }}</p>
                                </div>
                                {{-- Architecture --}}
                                <div class="col px-0">
                                    <h5 class="text-start mb-1">@lang('assignment.architecture')</h5>
                                    <p class="t-lightgray rounded-2 th-lightergray py-2 mb-0">{{ $pc->architecture }}</p>
                                </div>
                            </div>
                            <div class="row text-center fs-5 px-3 pb-3">
                                {{-- BIOS Key --}}
                                <div class="col me-3 px-0">
                                    <h5 class="text-start mb-1">@lang('assignment.bioskey')</h5>
                                    <p class="t-lightgray rounded-2 th-lightergray py-2 mb-0">{{ $pc->bios_key }}</p>
                                </div>
                                {{-- Brand --}}
                                <div class="col px-0">
                                    <h5 class="text-start mb-1">@lang('assignment.brand')</h5>
                                    <p class="t-lightgray rounded-2 th-lightergray py-2 mb-0">{{ $pc->brand }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Notes --}}
                    <div class="col">
                        <div class="container-fluid rounded-3 th-gray h-100">
                            <div class="row p-3 pb-0 h-100">
                                <div class="col">
                                    <h5 class="fw-bold ps-0">@lang('assignment.additionalnotes')</h5>
                                    @isset($note->text)
                                    <p class="t-lightgray fs-5 ps-2">{{ $note->text }}</p>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Tasks --}}
                <div class="row mb-3">
                    <div class="col-auto th-gray rounded-3">
                        <div class="p-3">
                            <h5 class="fw-bold mb-3">@lang('assignment.tasks')</h5>
                            <div class="container-fluid fs-5">
                                <form action="{{URL::Route('assignment.changeDone', $assignment)}}" method="post" id="tasksform">
                                    @csrf
                                    {{-- Default-Tasks --}}
                                    @foreach ($device_default_tasks as $device_default_task)

                                    <div class="row mb-2">
                                        @if ($device_default_task->finished == 1)

                                            <div class="col-auto">
                                                <input type='hidden' value='uncheck' name='default_tasks[{{ $device_default_task->default_task_id }}]'>
                                                <input class="form-check-input" type="checkbox" value="1" id="default_task-{{ $device_default_task->default_task_id }}" name="default_tasks[{{ $device_default_task->default_task_id }}]" checked>
                                            </div>
                                            <div class="col rounded-2 b-lightgray">
                                                <label class="form-check-label" for="default_task-{{ $device_default_task->default_task_id }}">{{ $device_default_task->default_task->text }}</label>
                                            </div>

                                        @else

                                            <div class="col-auto">
                                                <input class="form-check-input" type="checkbox" value="check" id="default_task-{{ $device_default_task->default_task_id }}" name="default_tasks[{{ $device_default_task->default_task_id }}]">
                                            </div>
                                            <div class="col rounded-2 b-lightgray">
                                                <label class="form-check-label" for="default_task-{{ $device_default_task->default_task_id }}">{{ $device_default_task->default_task->text }}</label>
                                            </div>

                                        @endif
                                    </div>

                                    @endforeach
                                    {{-- Additional-Tasks --}}
                                    @foreach ($tasks as $key => $task)

                                        @if ($key == count($tasks)-1)

                                            <div class="row">

                                        @else

                                            <div class="row mb-2">

                                        @endif
                                            @if ($task->finished)

                                                <div class="col-auto">
                                                    <input type='hidden' value='uncheck' name='tasks[{{$task->id}}]'>
                                                    <input class="form-check-input" type="checkbox" id="task-{{ $task->id }}" name="tasks[{{$task->id}}]" value="1" checked>
                                                </div>
                                                <div class="col rounded-2 b-lightgray">
                                                    <label class="form-check-label" for="task-{{ $task->id }}">{{ $task->text }}</label>
                                                </div>

                                            @else

                                                <div class="col-auto">
                                                    <input class="form-check-input" type="checkbox" id="task-{{ $task->id }}" name="tasks[{{$task->id}}]" value="check">
                                                </div>
                                                <div class="col rounded-2 b-lightgray">
                                                    <label class="form-check-label" for="task-{{ $task->id }}">{{ $task->text }}</label>
                                                </div>

                                            @endif
                                        </div>

                                    @endforeach
                                    <input type='hidden' value='{{ $assignment->repair_object->id }}' name='repair_object_id'>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- History --}}
                @if(! $histories->isEmpty())

                    <div class="row mb-3">
                        <div class="col-auto th-gray rounded-3">
                            <div class="p-3">
                                <h5 class="fw-bold mb-3">@lang('assignment.history')</h5>
                                <div class="container-fluid ms-2">
                                    @foreach ($assignmentHistories as $assignmentHistory)

                                        <div class="row th-lightergray p-2 rounded-2 mb-3">
                                            <div class="col-auto p-0">
                                                <img class="rounded-circle th-lightgray img-50" src="{{ $assignmentHistory['history']->done_by_user->gravatar }}" alt="{{ __('header.profile') }}" id="historyprofileimg">
                                            </div>
                                            <div class="col my-auto">
                                                <p class="m-0 fs-5">
                                                    <b>{{ $assignmentHistory['history']->done_by_user->name }}</b>
                                                    @lang('assignment.changed')
                                                    {{ isset($assignmentHistory['name']) ? __('profile.label.name') . ' ' . __('assignment.from') . ' ' . $assignmentHistory['history']->name . ' ' . __('assignment.to') . ' ' . $assignmentHistory['object']->name : "" }}
                                                    {{ isset($assignmentHistory['priority']) ? __('assignment.priority') . ' ' . __('assignment.from') . ' ' . $assignmentHistory['history']->getPriority() . ' ' . __('assignment.to') . ' ' . $assignmentHistory['object']->getPriority() : "" }}
                                                    {{ isset($assignmentHistory['state']) ? __('assignment.state') . ' ' . __('assignment.from') . ' ' . $assignmentHistory['history']->getState() . ' ' . __('assignment.to') . ' ' . $assignmentHistory['object']->getState() : "" }}
                                                    {{ isset($assignmentHistory['workshop_id']) ? __('assignment.workshop') . ' ' . __('assignment.from') . ' ' . $assignmentHistory['history']->workshop->name . ' ' . __('assignment.to') . ' ' . $assignmentHistory['object']->workshop->name : "" }}
                                                    @lang('assignment.on')
                                                    {{  date('d.m.Y', strtotime($assignmentHistory['history']->historical_timestamp)) }} {{ __('home.news.createdat') }} {{  date('H:i', strtotime($assignmentHistory['history']->historical_timestamp)) }}
                                                </p>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                @endif
                <div class="row text-center">
                    {{-- Save Button --}}
                    <div class="col-1 px-0 me-3">
                        <button class="btn btn-primary w-100 th-orange border border-2 bc-orange t-gray fw-bold fs-5" type="submit" form="tasksform" id="savebtn">@lang('home.news.create.save')</button>
                    </div>
                    {{-- Edit Button --}}
                    <div class="col-1 px-0">
                        <a class="btn btn-primary w-100 bg-transparent border border-2 bc-orange t-orange fw-bold fs-5" id="editbtn" href="{{URL::Route('assignment.edit', $assignment)}}">
                            @lang('admin.edit')
                       </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
