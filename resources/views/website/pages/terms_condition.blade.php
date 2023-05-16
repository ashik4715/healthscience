@extends('website.layouts.master')
@section('title')
Terms and Condition | International Medical Journal
@endsection
@section('content')

<div class="site-section bg-color first-section pt-4 pb-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4 pt-3" data-aos="fade">
                <h3>Terms and Condition</h3>
                @foreach($terms as $term)
                <p><strong>{{$term->terms_title}}</strong></p>
                <div style="padding-left: 14px; margin-bottom: -30px;">
                    <p>
                        {!! $term->terms_description !!}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
