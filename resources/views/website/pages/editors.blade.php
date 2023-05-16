@extends('website.layouts.master')
@section('title')
    Editorial Board | International Medical Journal
@endsection
@section('content')

<div class="site-section bg-color first-section pt-4 pb-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4 pt-3" data-aos="fade">
                <h3>International Medical Journal Editors-Panel</h3>
                @foreach($editors as $editor)
                    <div class="col-md-12">
                        <div class="_card-body pl-4 pr-4">
                            <div class="media well" style="_width: 90%">
                                <img class="rounded-circle mr-4" src="{{ asset('images/editor_panel_profile/'.$editor->image) }}" alt="Nobou Kondo" title="Nobou Kondo" width="100">
                                <div class="media-body">
                                    <div><strong><a href="#">{{ $editor->name }}</a></strong></div>
                                    <div><strong>{{ $editor->editor_position }}</strong></div>
                                    <div>{!!  $editor->description  !!}</div>
                                    <div>E-mail: {{ $editor->email }}</div>
                                    <div>Web: {{ $editor->web }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-12 d-flex justify-content-center">
                    <div class="text-center">
                        {{$editors->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
