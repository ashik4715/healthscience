@extends('website.layouts.master')
@section('title')
    Privacy Policy | International Medical Journal
@endsection
@section('content')

<div class="site-section bg-color first-section pt-4 pb-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4 pt-3" data-aos="fade">
                <h3>Privacy Policy</h3>
                @foreach($privacys as $privacy)
                    <div class="">
                        <p><strong>{{$privacy->privacy_title}}</strong></p>
                        <div style="padding-left: 14px; margin-bottom: -30px;">
                            <p>
                                {!! $privacy->privacy_description !!}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
