@extends('layouts.app')

@section('title', __('sidebar.home'))

@section('content')

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col">
                <div class="container-fluid p-0">
                    {{-- Buttons --}}
                    <div class="row mb-3">
                        {{-- Create-Assignment-Button --}}
                        <div class="col text-center">
                            <div class="h-100">
                                <a class="rounded text-decoration-none" href="{{ URL::route('assignment.create') }}" title="{{ __('sidebar.createassignment') }}" id="homebtn">
                                    <div class="th-gray rounded-3 h-100">
                                        <img class="p-1 rounded img-150" src="{{ asset('/img/icons/lightgray/plus.png') }}" alt="{{ __('sidebar.createassignment') }}">
                                        <p class="align-middle ms-2 text-uppercase t-lightgray fw-bold fs-1">{{ __('sidebar.createassignment') }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        {{-- Assignments-Button --}}
                        <div class="col text-center">
                            <div class="h-100">
                                <a class="rounded text-decoration-none" href="{{ URL::route('assignment.index') }}" title="{{ __('sidebar.assignments') }}" id="homebtn">
                                    <div class="th-gray rounded-3 h-100">
                                        <img class="p-1 rounded img-150" src="{{ asset('img/icons/lightgray/clipboard-list.svg') }}" alt="{{ __('sidebar.assignments') }}">
                                        <p class="align-middle ms-2 text-uppercase t-lightgray fw-bold fs-1">{{ __('sidebar.assignments') }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    {{-- Workshops-Button --}}
                    <div class="row">
                        <div class="col text-center">
                            <a class="rounded mb-3 text-decoration-none" href="{{ URL::route('workshop.index') }}" title="{{ __('sidebar.workshops') }}" id="homebtn">
                                <div class="th-gray rounded-3">
                                    <img class="p-1 rounded img-150" src="{{ asset('img/icons/lightgray/warehouse.svg') }}" alt="{{ __('sidebar.workshops') }}">
                                    <p class="align-middle ms-2 text-uppercase t-lightgray fw-bold fs-1">{{ __('sidebar.workshops') }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    {{-- Assignment-Progress --}}
                    <div class="row mb-3">
                        <div class="col">
                            <div class="container-fluid p-3 th-gray rounded-3 t-white" id="assignmentprogress">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="t-orange">{{ __('home.assignmentprogress') }}</h3>
                                    </div>
                                </div>
                                <div class="row mx- justify-content-center">
                                    {{-- Legend --}}
                                    <div class="col-6 my-auto">
                                        <div class="row">
                                            {{-- Not Assigned --}}
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <div class="rounded-2 th-yellow border border-2 bc-white" id="assignmentprogresscolordiv"></div>
                                                    </div>
                                                    <div class="col-auto ps-0">
                                                        <p class="text-uppercase">{{ __('home.assignmentprogress.notassigned') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Waiting --}}
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <div class="rounded-2 th-lightgray border border-2 bc-white" id="assignmentprogresscolordiv"></div>
                                                    </div>
                                                    <div class="col-auto ps-0">
                                                        <p class="text-uppercase">{{ __('home.assignmentprogress.waiting') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            {{-- In Progress --}}
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <div class="rounded-2 th-purple border border-2 bc-white" id="assignmentprogresscolordiv"></div>
                                                    </div>
                                                    <div class="col-auto ps-0">
                                                        <p class="text-uppercase">{{ __('home.assignmentprogress.inprogress') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Ready --}}
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <div class="rounded-2 th-blue border border-2 bc-white" id="assignmentprogresscolordiv"></div>
                                                    </div>
                                                    <div class="col-auto ps-0">
                                                        <p class="text-uppercase">{{ __('home.assignmentprogress.ready') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            {{-- Paused --}}
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <div class="rounded-2 th-orange border border-2 bc-white" id="assignmentprogresscolordiv"></div>
                                                    </div>
                                                    <div class="col-auto ps-0">
                                                        <p class="text-uppercase">{{ __('home.assignmentprogress.paused') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Done --}}
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-auto" id="assignmentprogressorangebtn">
                                                        <div class="rounded-2 th-green border border-2 bc-white" id="assignmentprogresscolordiv"></div>
                                                    </div>
                                                    <div class="col-auto ps-0">
                                                        <p class="text-uppercase">{{ __('home.assignmentprogress.done') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            {{-- Cancelled --}}
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <div class="rounded-2 th-red border border-2 bc-white" id="assignmentprogresscolordiv"></div>
                                                    </div>
                                                    <div class="col-auto ps-0">
                                                        <p class="text-uppercase">{{ __('home.assignmentprogress.cancelled') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Placeholder --}}
                                            <div class="col-auto">

                                            </div>
                                        </div>
                                    </div>
                                    {{-- Progress-circle --}}
                                    <div class="col-auto my-auto">
                                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                        <canvas id="assignmentprogresscircle" width="300" height="300"></canvas>
                                        <script>

                                            //Get values from php variable

                                            const assignmentvalues = @php echo json_encode($state); @endphp

                                            //Check if assignmentvalues has values

                                            @if (!empty(array_filter($state)))

                                                test = 1

                                            @else

                                                test = 0

                                            @endif

                                            if (test === 0) {

                                                backgroundColor = [

                                                    '#222222'

                                                ];
                                                data = [

                                                    1

                                                ];
                                                tooltip = false;

                                            } else {

                                                backgroundColor = [

                                                    "#f89406",
                                                    "#999999",
                                                    "#702963",
                                                    "#f55c20",
                                                    "#064779",
                                                    "#5cb85c",
                                                    "#b94a48"

                                                ];
                                                data = [

                                                    assignmentvalues['notAssigned'],
                                                    assignmentvalues['waiting'],
                                                    assignmentvalues['inProgress'],
                                                    assignmentvalues['paused'],
                                                    assignmentvalues['ready'],
                                                    assignmentvalues['done'],
                                                    assignmentvalues['cancelled']

                                                ];
                                                tooltip = true;

                                            }

                                            //Create chart with values

                                            new Chart(document.getElementById("assignmentprogresscircle", assignmentvalues), {

                                                type: 'doughnut',
                                                data: {

                                                    datasets: [{

                                                        label: "",
                                                        backgroundColor: backgroundColor,
                                                        data: data

                                                    }]

                                                },
                                                options: {

                                                    plugins: {

                                                        legend: {

                                                            display: false,
                                                            position: 'left',
                                                            align: 'center',

                                                        },
                                                        tooltip: {
                                                            enabled: tooltip
                                                        }

                                                    },
                                                    borderColor: '#fffee8',
                                                    hoverBorderColor: '#fffee8'

                                                }

                                            });

                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Progress-Buttons --}}
                    <div class="row mb-3">
                        {{-- Not Assigned --}}
                        <div class="col text-center">
                            <div class="h-100">
                                <a class="rounded text-decoration-none" href="{{ URL::route('assignment.index', ['state' => '1']) }}" title="{{ __('home.assignmentprogress.notassigned') }}" id="homebtn">
                                    <div class="th-gray rounded-3 py-3 mb-3 h-100">
                                        <p class="mb-0 t-lightgray fw-bold fs-1">{{$state['notAssigned']}}</p>
                                        <p class="align-middle mb-0 text-uppercase t-lightgray fw-bold fs-1">{{ __('home.assignmentprogress.notassigned') }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        {{-- Waiting --}}
                        <div class="col text-center">
                            <div class="h-100">
                                <a class="rounded text-decoration-none" href="{{ URL::route('assignment.index', ['state' => '2']) }}" title="{{ __('home.assignmentprogress.waiting') }}" id="homebtn">
                                    <div class="th-gray rounded-3 py-3 mb-3 h-100">
                                        <p class="mb-0 t-lightgray fw-bold fs-1">{{$state['waiting']}}</p>
                                        <p class="align-middle mb-0 text-uppercase t-lightgray fw-bold fs-1">{{ __('home.assignmentprogress.waiting') }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        {{-- Done --}}
                        <div class="col text-center">
                            <div class="h-100">
                                <a class="rounded mb-3 text-decoration-none" href="{{ URL::route('assignment.index', ['state' => '6']) }}" title="{{ __('home.assignmentprogress.done') }}" id="homebtn">
                                    <div class="th-gray rounded-3 py-3 mb-3 h-100">
                                        <p class="mb-0 t-orange fw-bold fs-1" id="assignmentprogressorangebtn">{{$state['done']}}</p>
                                        <p class="align-middle mb-0 text-uppercase t-orange fw-bold fs-1" id="assignmentprogressorangebtn">{{ __('home.assignmentprogress.done') }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- Paused --}}
                        <div class="col text-center">
                            <div class="h-100">
                                <a class="rounded mb-3 text-decoration-none" href="{{ URL::route('assignment.index', ['state' => '4']) }}" title="{{ __('home.assignmentprogress.paused') }}" id="homebtn">
                                    <div class="th-gray rounded-3 py-3 mb-3 h-100">
                                        <p class="mb-0 t-lightgray fw-bold fs-1">{{$state['paused']}}</p>
                                        <p class="align-middle mb-0 text-uppercase t-lightgray fw-bold fs-1">{{ __('home.assignmentprogress.paused') }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        {{-- Ready --}}
                        <div class="col text-center">
                            <div class="h-100">
                                <a class="rounded mb-3 text-decoration-none" href="{{ URL::route('assignment.index', ['state' => '5']) }}" title="{{ __('home.assignmentprogress.ready') }}" id="homebtn">
                                    <div class="th-gray rounded-3 py-3 mb-3 h-100">
                                        <p class="mb-0 t-lightgray fw-bold fs-1">{{$state['ready']}}</p>
                                        <p class="align-middle mb-0 t-lightgray fw-bold fs-1">{{ __('home.assignmentprogress.ready') }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        {{-- Cancelled --}}
                        <div class="col text-center">
                            <div class="h-100">
                                <a class="rounded mb-3 text-decoration-none" href="{{ URL::route('assignment.index', ['state' => '7']) }}" title="{{ __('home.assignmentprogress.cancelled') }}" id="homebtn">
                                    <div class="th-gray rounded-3 py-3 mb-3 h-100">
                                        <p class="mb-0 t-orange fw-bold fs-1" id="assignmentprogressorangebtn">{{$state['cancelled']}}</p>
                                        <p class="align-middle mb-0 text-uppercase t-orange fw-bold fs-1" id="assignmentprogressorangebtn">{{ __('home.assignmentprogress.cancelled') }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- News/Team --}}
            <div class="col">
                {{-- News --}}
                <div class="container-fluid p-3 th-gray rounded-3 mb-3 t-white" id="news">
                    <div class="row">
                        <div class="col">
                            <h3 class="t-orange">{{ __('home.news') }}</h3>
                        </div>
                        <div class="col text-end">
                            <button class="t-orange bg-transparent border-0 hover-underline" title="{{ __('home.news.create') }}" onclick="showCreatePostForm()" id="createpostbtn">+ {{ __('home.news.create') }}</button>
                        </div>
                    </div>

                    {{-- Create-Post-Form --}}
                    <form class="d-none" method="POST" action="{{ route('news.store') }}" id="createpostform">
                        @csrf
                        <textarea class="w-100 rounded-2 ps-3 pe-3 pt-2 th-lightergray t-white border-0 i-outline-none i-resize-none" name="text" id="text" rows="6"></textarea>
                        <div>
                            <input class="rounded-1 th-orange t-gray fw-bold border-0" type="submit" title="{{ __('home.news.create.save') }}" value="{{ __('home.news.create.save') }}">
                            <a class="t-orange text-decoration-none hover-underline" href="javascript:void(0)" title="{{ __('home.news.create.cancel') }}" onclick="hideCreatePostForm()" id="createpostcancelbtn">{{ __('home.news.create.cancel') }}</a>
                        </div>
                    </form>
                    {{-- Articles --}}
                    @if (count($news) > 0)

                        <div id="articles">
                            @php

                                $newscounter = 0

                            @endphp
                            @foreach ($news as $article)

                                @php

                                    $newscounter++;

                                @endphp

                                <div class="container-fluid my-3">
                                    <div class="row">
                                        <div class="col-auto">
                                            <img class="rounded-circle th-lightgray img-40" src="{{ \App\Models\User::find($article->user_id)->gravatar }}" alt="{{ __('header.profile') }}" id="articleprofileimg">
                                        </div>
                                        {{-- Article --}}
                                        <div class="col rounded-2 p-2 pt-1 th-lightergray" id="article">
                                            <div class="container-fluid p-0">
                                                <div class="row">
                                                    {{-- Name --}}
                                                    <div class="col pt-1">
                                                        <h5>{{ \App\Models\User::find($article->user_id)->name }}</h5>
                                                    </div>
                                                    {{-- Date --}}
                                                    <div class="col pt-1 text-end">
                                                        <p id="articledate">
                                                            {{ $article->created_at->format('d.m.Y') }}
                                                            {{ __('home.news.createdat') }}
                                                            {{ $article->created_at->format('H:i') }}
                                                        </p>
                                                    </div>
                                                    {{-- 3-Dots --}}

                                                    <div class="col-auto text-end">
                                                        <div class="ndropdown">
                                                            <button class="btn btn-secondary dropdown-toggle t-orange bg-transparent border-0 d-dropdownafter-none" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="newsdropdown">
                                                                <img class="img-20" src="{{ asset('img/icons/ellipsis-vertical.svg') }}" alt="3 Dots" id="articleellipsis">
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-dark shadow th-gray" id="languagedropdownul">
                                                                {{-- Edit Article Button --}}
                                                                <li>
                                                                    <button class="t-white bg-transparent border-0 hover-underline" onclick="showEditPostForm({{$article->id}})" id="editpostbtn">@lang('admin.edit')</button>
                                                                </li>
                                                                {{-- Delete Article Button --}}
                                                                <li>
                                                                    <form method="POST" action="{{ route('news.destroy', $article) }}" id="newsdestroy{{$article->id}}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="t-orange bg-transparent border-0 hover-underline" type="button" onclick="changeModalSubmitButton('newsdestroy{{$article->id}}')" data-bs-toggle="modal" data-bs-target="#deletemodal">
                                                                            {{ __('home.news.delete') }}
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="articlecontent{{$article->id}}">
                                                    {{-- Article Text --}}
                                                    <div class="row" id="articletext">
                                                        <p>{{ $article->text }}</p>
                                                    </div>
                                                    {{-- Edit Article --}}
                                                    <div class="row d-none" id="articleedit">
                                                        <form method="POST" action="{{ route('news.update', $article) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <textarea class="w-100 rounded-2 ps-2 pe-2 pt-2 th-lightertolightgray t-white border-0 i-outline-none i-resize-none" name="text" id="text" rows="6">{{$article->text}}</textarea>
                                                            <div>
                                                                <input class="rounded-1 th-orange t-gray fw-bold border-0" type="submit" value="{{ __('home.news.create.save') }}">
                                                                <a class="t-orange text-decoration-none hover-underline" onclick="hideEditPostForm({{$article->id}})" id="editpostcancelbtn">{{ __('home.news.create.cancel') }}</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if ($newscounter == 2)

                                    @break

                                @endif

                            @endforeach
                            {{-- Read-More-Articles --}}
                            <div class="d-none" id="readmorearticles">
                                @php

                                    $newscounter = 0

                                @endphp
                                @for ($i = 2; $i <= count($news) - 1; $i++)
                                    @php

                                        $article = $news[$i];
                                        $newscounter++;

                                    @endphp
                                    <div class="container-fluid my-3">
                                        <div class="row">
                                            <div class="col-auto">
                                                <img class="rounded-circle th-lightgray img-40" src="{{ \App\Models\User::find($article->user_id)->gravatar }}" alt="{{ __('header.profile') }}" id="articleprofileimg">
                                            </div>
                                            {{-- Article --}}
                                            <div class="col rounded-2 p-2 pt-1 th-lightergray" id="article">
                                                <div class="container-fluid p-0">
                                                    <div class="row">
                                                        {{-- Name --}}
                                                        <div class="col pt-1">
                                                            <h5>{{ \App\Models\User::find($article->user_id)->name }}</h5>
                                                        </div>
                                                        {{-- Date --}}
                                                        <div class="col pt-1 text-end">
                                                            <p id="articledate">
                                                                {{ $article->created_at->format('d.m.Y') }}
                                                                {{ __('home.news.createdat') }}
                                                                {{ $article->created_at->format('H:i') }}
                                                            </p>
                                                        </div>
                                                        {{-- 3-Dots --}}

                                                        <div class="col-auto text-end">
                                                            <div class="ndropdown">
                                                                <button class="btn btn-secondary dropdown-toggle t-orange bg-transparent border-0 d-dropdownafter-none" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="newsdropdown">
                                                                    <img class="img-20" src="{{ asset('img/icons/ellipsis-vertical.svg') }}" alt="3 Dots" id="articleellipsis">
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-dark shadow th-gray" id="languagedropdownul">
                                                                    {{-- Edit Article Button --}}
                                                                    <li>
                                                                        <button class="t-white bg-transparent border-0 hover-underline" onclick="showEditPostForm({{$article->id}})" id="editpostbtn">@lang('admin.edit')</button>
                                                                    </li>
                                                                    {{-- Delete Article Button --}}
                                                                    <li>
                                                                        <form method="POST" action="{{ route('news.destroy', $article) }}" id="newsdestroy{{$article->id}}">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button class="t-orange bg-transparent border-0 hover-underline" type="button" onclick="changeModalSubmitButton('newsdestroy{{$article->id}}')" data-bs-toggle="modal" data-bs-target="#deletemodal">
                                                                                {{ __('home.news.delete') }}
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="articlecontent{{$article->id}}">
                                                        {{-- Article Text --}}
                                                        <div class="row" id="articletext">
                                                            <p>{{ $article->text }}</p>
                                                        </div>
                                                        {{-- Edit Article --}}
                                                        <div class="row d-none" id="articleedit">
                                                            <form method="POST" action="{{ route('news.update', $article) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <textarea class="w-100 rounded-2 ps-2 pe-2 pt-2 th-lightertolightgray t-white border-0 i-outline-none i-resize-none" name="text" id="text" rows="6">{{$article->text}}</textarea>
                                                                <div>
                                                                    <input class="rounded-1 th-orange t-gray fw-bold border-0" type="submit" value="{{ __('home.news.create.save') }}">
                                                                    <a class="t-orange text-decoration-none hover-underline" onclick="hideEditPostForm({{$article->id}})" id="editpostcancelbtn">{{ __('home.news.create.cancel') }}</a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($newscounter == 5)

                                        @break

                                    @endif
                                @endfor
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
                                                        <p class="mb-0 fs-5" id="deletemodaltext">@lang('delete.sure.post')</p>
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

                    @else

                        <div class="rounded-2 py-5 text-center d-flex th-lightergray" id="noarticles">
                            <h5 class="m-auto t-lightgray fw-bold fs-3">{{ __('home.news.none') }}</h5>

                        </div>
                    @endif
                    <div>
                        <button class="t-orange bg-transparent border-0 hover-underline" title="{{ __('home.news.readmore') }}" onclick="showNews()" id="readmorebtn">{{ __('home.news.readmore') }}</button>
                    </div>
                    <div>
                        <button class="t-orange bg-transparent border-0 d-none hover-underline" title="{{ __('home.news.readless') }}" onclick="hideNews()" id="readlessbtn">{{ __('home.news.readless') }}</button>
                    </div>
                </div>
                {{-- Team --}}
                <div class="th-gray p-3 rounded-3" id="team">
                    <div class="row">
                        <div class="col">
                            <h3 class="t-orange">{{ __('home.team') }}</h3>
                        </div>
                    </div>
                    <div class="row text-center my-auto mb-3 mt-4">
                        @foreach ($users as $user)

                            @if ($teamcounter == 0 || $teamcounter % 3)

                                <div class="col-4">
                                    <div class="rounded-2 h-100 border border-2 bc-lightergray" id="teamdiv">
                                        <img class="mb-2 rounded-circle th-lightgray img-50" src="{{ \App\Models\User::find($user->id)->gravatar }}" alt="{{ __('header.profile') }}" id="teamprofileimg">
                                        <h5 class="fw-bold">{{ $user->name }}</h5>
                                        @foreach ($user->role_ids as $role_id)

                                            @if ($role_id == "1")

                                                <p class="badge bg-warning th-red">
                                                    @lang('home.team.admin')
                                                </p>

                                            @elseif ($role_id == "2")

                                                <p class="badge bg-warning th-blue">
                                                    @lang('home.team.technician')
                                                </p>

                                            @else

                                                <p class="badge bg-warning th-yellow">
                                                    @lang('home.team.supporter')
                                                </p>

                                            @endif

                                        @endforeach
                                    </div>
                                </div>

                            @else

                                </div>
                                <div class="row text-center my-auto mb-3 mt-4">
                                    <div class="col-4">
                                        <div class="rounded-2 h-100 border border-2 bc-lightergray" id="teamdiv">
                                            <img class="mb-2 rounded-circle th-lightgray img-50" src="{{ \App\Models\User::find($user->id)->gravatar }}" alt="{{ __('header.profile') }}" id="teamprofileimg">
                                            <h5 class="fw-bold">{{ $user->name }}</h5>
                                            @foreach ($user->role_ids as $role_id)

                                                @if ($role_id == "1")

                                                <p class="badge bg-warning th-red">
                                                    @lang('home.team.admin')
                                                </p>

                                                @elseif ($role_id == "2")

                                                    <p class="badge bg-warning th-blue">
                                                        @lang('home.team.technician')
                                                    </p>

                                                @else

                                                    <p class="badge bg-warning th-yellow">
                                                        @lang('home.team.supporter')
                                                    </p>

                                                @endif

                                            @endforeach
                                        </div>
                                    </div>

                            @endif

                        @php

                            $teamcounter++;

                        @endphp
                        @endforeach

                        @if ($teamcounter == 0 || $teamcounter % 3)

                            <div class="col"></div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
