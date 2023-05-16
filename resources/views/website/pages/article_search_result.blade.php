@extends('website.layouts.master')
@section('title','International Medical Journal | IMJ')
{{-- @section('meta')

@endsection --}}
@section('content')
<div class="site-section bg-color first-section pt-4 pb-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4 pt-3" data-aos="fade">
                <h3>About Us</h3>
                <div class="row">

                                                                @if(count($journals)>0)
                                                                    @foreach($journals as $journal)
                                                                        <div class="col-md-12 well _border-1 pt-2 pb-3">

                                                                            <div class="">
                                                                                <div class="row">
                                                                                    <div class="col-md-7">
                                                                                        <h5>International Medical Journal</h5>
                                                                                    </div>
                                                                                    <div class="col-md-3 _text-right">
                                                                                        <span class="btn btn-primary btn-xs">Journal ID</span> : <span style="font-weight: bolder; color: red;">{{$journal->paper_id}}</span>
                                                                                    </div>
                                                                                    <div class="col-md-2 _text-right">
                                                                                        <span class="btn btn-primary btn-xs text-right">Total View</span> : <span style="font-weight: bolder; color: red;">{{$journal->view_count}}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <hr>
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <strong>Title </strong>:
                                                                                        <a class="title-link" onclick="view_count_submit('<?php echo $journal->id;?>')" href="{{ route('single_article',$journal->title_slug) }}">
                                                                                            <span>{{  $journal->ptitle}}</span>
                                                                                        </a>
                                                                                        <div class="authors text-information">by
                                                                                            <span class="mr-5">
                                                                                                 <?php
                                                                                                    $author_names = json_decode($journal->author_name, true);
                                                                                                    foreach ($author_names as $key => $author_name) {
                                                                                                        ?>
                                                                                                        <span class="inlineblock">
                                                                                                             <?php if ($author_name != '') echo $author_name.","; ?>
                                                                                                        </span>
                                                                                                        <?php
                                                                                                    };
                                                                                                 ?>
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="abstract-div">
                                                                                    <div class="abstract-cropped" style="display:block; text-align: justify;">
                                                                                        <strong>Abstract </strong>: {!! $journal->abstract !!}. <br>
                                                                                        <a class="" href="{{ route('single_article',$journal->title_slug) }}">Full article</a>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                    <div class="col-md-12 d-flex justify-content-center">
                                                                        <div class="text-center">
                                                                            {{$journals->links()}}
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <div class="col-md-12 well">
                                                                        <div class="item" style="text-align: center;">
                                                                           <h1 style="color: red">Opps !!</h1>
                                                                           <h3>No data Found</h3><br>
                                                                            <div class="abstract-div">
                                                                                <div class="abstract-cropped" style="display:block; text-align: center;">
                                                                                    Go to <a href="/">Home</a>
                                                                                </div>
                                                                                <br>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
            </div>
        </div>
    </div>
</div>



    </section>


@endsection
