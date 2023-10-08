@extends('layouts.app')

@section('title', __('sidebar.workshops'))

@section('content')

    <div id="workshops">
        <h1 class="text-capitalize t-orange fw-bold">@lang('sidebar.workshops')</h1>
        <div class="container-fluid rounded-3 th-gray pt-3 pb-1">
            @foreach ($workshops as $workshop)

                <div class="row th-lightergray rounded rounded-2 mb-3 mx-1">
                    <a class="text-decoration-none t-white" href="{{URL::route('assignment.index', ['workshop' => $workshop->id])}}">
                        <div class="col ms-1">
                            <div class="container-fluid">
                                {{-- Name - Adress --}}
                                <div class="row mt-3">
                                    <div class="col-auto ps-0">
                                        <p class="mb-2 fs-5"><b>{{ $workshop->name }}</b> - {{ $workshop->address }}</p>
                                    </div>
                                </div>
                                {{-- In Progress / All Assignments of specific state --}}
                                <div class="row mb-3 text-center">
                                    @foreach ($workshop['state'] as $index => $state)

                                        <div class="col th-lightertolightgray rounded rounded-2 me-2 py-3 fs-5">
                                            @if ($index<5)

                                                <p class="my-auto t-lightgray"><b>{{$states[$index] . ': ' . $state['notfinished'] . '/' . $state['finished']}}</b></p>

                                            @else

                                                <p class="my-auto t-orange"><b>{{$states[$index] . ': ' . $state['notfinished'] . '/' . $state['finished']}}</b></p>

                                            @endif
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            @endforeach
        </div>
    </div>

@endsection
