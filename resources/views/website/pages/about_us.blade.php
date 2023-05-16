@extends('website.layouts.master')
@section('title','About Us | International Medical Journal')

@section('content')    
<div class="site-section bg-color first-section pt-4 pb-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4 pt-3" data-aos="fade">
                <h3>About Us</h3>
                {!! $about_us->description !!}

                <p><strong>Peer Review</strong></p>
                <div style="padding-bottom: 6px; padding-left: 14px;">
                    {!! $about_us->peer_review !!}
                </div>

                <p><strong>Broad Scope</strong></p>
                <div style="padding-bottom: 6px; padding-left: 14px;">
                    {!! $about_us->broad_scope !!}
                </div>

                <p><strong>Indexed</strong></p>
                <div style="padding-bottom: 6px; padding-left: 14px;">
                    {!! $about_us->indexed !!}
                </div>

                <p><strong>Open Access</strong></p>
                <div style="padding-bottom: 6px; padding-left: 14px;">
                    {!! $about_us->open_access !!}
                </div>

                <p><strong>Fast Track Peer</strong></p>
                <div style="padding-bottom: 6px; padding-left: 14px;">
                    {!! $about_us->fast_track_peer !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
