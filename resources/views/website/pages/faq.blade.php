@extends('website.layouts.master')
@section('title')
    FAQ | International Medical Journal
@endsection
@section('content')

<div class="site-section bg-color first-section pt-4 pb-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4 pt-3" data-aos="fade">
                <h3>FAQs</h3>
                <div>
                    @foreach($faqs as $faq)
                    <ul>
                        <li><strong>{{ $faq->faq_question}}</strong></li>
                    </ul>
                    <p>{!! $faq->faq_answer !!}</p>
                   @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
