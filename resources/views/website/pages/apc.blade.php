@extends('website.layouts.master')
@section('title')
APC | International Medical Journal
@endsection
@section('content')
<div class="site-section bg-color first-section pt-4 pb-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4 pt-3" data-aos="fade">
                <h3>Article Processing Charges</h3>
                <div>
                    @if(count($apcs)>0)
                    @foreach($apcs as $apc)
                    <p><strong>{{ $apc->apc_title }}</strong></p>
                    {!! $apc->apc_description !!}
                    @endforeach
                    @else
                    <h4 class="text-center">Article Processing Charges list Showing here !!</h4>
                    @endif
                </div>
                <div class="container text-center">

                    <div class="row border p-2" style="background-color: #f3f3f3;">
                        <div class="col-md-8 text-left">
                            Journal
                        </div>
                        <div class="col-md-4 text-left">
                            Publication Fee (USD)
                        </div>
                    </div>
                    @foreach($categories as $category)
                    <div class="row p-1 border">
                        <div class="col-md-8 text-left">
                            <a href="" class="" title="{{$category->name}}" target="_blank">
                                {{$category->name}}
                            </a>
                        </div>
                        <div class="col-md-4 text-left">
                            <span class="text-success">  ${{$category->price}} </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
