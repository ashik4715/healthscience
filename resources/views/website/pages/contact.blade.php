@extends('website.layouts.master')
@section('title')
    Contacts | International Medical Journal
@endsection
@section('content')
<div class="site-section bg-color first-section pt-4 pb-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4 pt-3" data-aos="fade">
                <h3>contact</h3>
                 @foreach($contacts as $contact)
                                <div class="col-md-12 well">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <span>{{ $contact->office_name }}</span><br>
                                            <span>{{ $contact->location_name }}</span><br>
                                            <p>
                                                {{-- Phone : {{ $contact->telephone_no }}<br>
                                                Fax : {{ $contact->fax_no }}<br> --}}
                                                E-mail: contact@seronijihou.com<br>
                                                 <span class="ml-5">support@seronijihou.com</span>
                                            </p>
                                        </div>
                                        <div class="col-md-5">
                                            <img src="{{asset($contact->office_photo)}}" style="width: 100%; max-width: 200px; max-height: 143px;">
                                            {{-- <iframe src="{{ $contact->location_url }}" width="100%" height="250" frameborder="0" style="border:0;margin-top:5px;" allowfullscreen=""></iframe>--}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
