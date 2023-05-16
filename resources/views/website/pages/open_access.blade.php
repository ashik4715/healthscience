@extends('website.layouts.master')
@section('title')
    Open Access Policy| International Medical Journal
@endsection
@section('content')
<div class="site-section bg-color first-section pt-4 pb-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4 pt-3" data-aos="fade">
                <h3>Open Access Policy</h3>
                @foreach($open_access as $open_acces)
                <h5>{{ $open_acces->title }}</h5>
                <div style="padding-bottom: 6px; padding-left: 14px;">
                    {!! $open_acces->description !!}
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
