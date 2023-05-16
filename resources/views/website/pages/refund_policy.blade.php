@extends('website.layouts.master')
@section('title')
    Refund Policy | International Medical Journal
@endsection
@section('content')

<div class="site-section bg-color first-section pt-4 pb-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4 pt-3" data-aos="fade">
                <h3>Refund Policy</h3>
                @foreach($refund_policys as $refund_policy)
                    <div>
                        <p><strong>{{$refund_policy->refund_title}}</strong></p>
                        <div style="padding-left: 14px; margin-bottom: -30px;">
                            <p>
                                {!! $refund_policy->refund_description !!}
                            </p>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-center">
                    <p class="p-3">
                        For any further information contact us at <a href="#">support@mpipress.com</a> or <a
                                href="#">Contact Us</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
