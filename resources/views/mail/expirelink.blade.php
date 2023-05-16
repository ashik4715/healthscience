@extends('website.layouts.master')

@section('title', 'Author Registration Verification')

@push('css')

@endpush

@section('content')

    
    <div id="content" class="container">
        <div class="row d-flex justify-content-center">
            
            <div id="myJournals" class="col-8">
                <div id="" style="height: 300px;" class="card mt-4">
                    <h2 class="card-header">International Medical Journal (IMJ) <strong>ISSN: 13412051</strong></h2>
                    <div id="myAccount" class="card-body text-center" style="padding: 30px 20px;">
                        <h4 class="text-warning">The link you try to verify with your account that may have been already verified or expired. You may <a href="{{route('authorlogin')}}">Loign</a> now.</h4>
                        {{-- <h5><a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a></h5> --}}
                    </div>

                </div>
                
            </div>
        </div>
    </div>

@endsection

@push('scripts')

@endpush
