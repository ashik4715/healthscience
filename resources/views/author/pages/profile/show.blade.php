@extends('author.layouts.app')

@section('title', 'Author Profile')

@push('css')

@endpush

@section('content')

    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    @if(Auth::user()->image)
                        <img src="{{asset('images/author_profile/'.Auth::user()->image)}}" class="profile-user-img img-responsive img-circle" alt="User Image">
                    @else
                        <img src="{{asset('images/default.png')}}" class="profile-user-img img-responsive img-circle" alt="User Image">
                    @endif
                    <h3 class="profile-username text-center">{{Auth::user()->firstname }} {{Auth::user()->lastname}}</h3>
                    <p class="text-muted text-center">{{Auth::user()->role->name}}</p>
                    <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
                    <p class="text-muted">
                        {{Auth::user()->department}}
                        @if(Auth::user()->institution != null)
                            in
                        @endif
                        {{Auth::user()->institution}}
                    </p>
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                    <p class="text-muted">{{Auth::user()->address}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
                    <li><a href="#about" data-toggle="tab">About</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <!-- Post -->
                        @foreach($submits as $submit)
                        <div class="post">
                            <div class="user-block">
                                @if(Auth::user()->image)
                                    <img class="img-circle img-bordered-sm" src="{{asset('images/author_profile/'.Auth::user()->image)}}"
                                         alt="user image">
                                @else
                                    <img src="{{asset('images/default.png')}}" class="profile-user-img img-responsive img-circle" alt="User Image">
                                @endif
                                <span class="username">
                                  <a href="{{route('author.profile.show', Auth::user()->id)}}">{{$submit->user->firstname}}</a>
                                </span>
                                <span class="description">Shared publicly - {{date('d M Y', strtotime($submit->created_at))}}</span>
                            </div>
                            <div>
                                <p>
                                   Paper Title: <br> <a href="{{ $submit->publish == 1 ? route('single.article',$submit->title_slug):"javascript:void(0)" }}" target="_blank">{{$submit->ptitle}}</a>
                                </p>
                                <ul class="list-inline">
                                    <li>
                                        <span style="font-size: 14px">Paper ID: <span style="font-weight: bolder; color: red;">{{ $submit->paper_id }}</span></span>
                                    </li>
                                    </li>
                                    <li class="pull-right">
                                        <i class="fa fa-eye marSSSgin-r-5"></i>
                                        Total View
                                        ({{ $submit->view_count }})</li>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                        {{$submits->links()}}
                    </div>

                    <div class="tab-pane" id="about">
                        <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Title</label>
                                    <div class="col-sm-9">
                                        <span class="form-control">{{Auth::user()->prefix}}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">First Name</label>
                                    <div class="col-sm-9">
                                        <span class="form-control">{{Auth::user()->firstname}}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Middle Name</label>
                                    <div class="col-sm-9">
                                        <span class="form-control">{{Auth::user()->middlename}}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Last Name</label>
                                    <div class="col-sm-9">
                                        <span class="form-control">{{Auth::user()->lastname}}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-9">
                                        <span class="form-control">{{Auth::user()->email}}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Institution</label>
                                    <div class="col-sm-9">
                                        <span class="form-control">{{Auth::user()->institution}}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Department</label>
                                    <div class="col-sm-9">
                                        <span class="form-control">{{Auth::user()->department}}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Address</label>
                                    <div class="col-sm-9">
                                        <span class="form-control">{{Auth::user()->about}}</span>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
