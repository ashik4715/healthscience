@extends('website.layouts.master')
@section('title',$article->ptitle)

@section('content')

<div class="site-section bg-color first-section pt-4 pb-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4 pt-3" data-aos="fade">
                <h3>About the Journal</h3>
                <div class="row">
                    <div class="col">
                        <div class="">
                            @php
                            $volume = \App\Models\Submission_timer::find($article->issue_id);
                            $category = \App\Models\Category::find($article->journal_id);
                            @endphp
                            <div class="px-3">
                                @if(Session::has('success'))
                                <div class="alert alert-info alert-dismissible fade show mt-2" role="alert">
                                  {{Session::get('success')}}
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            @if(Session::has('danger'))
                            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                              <strong>Sorry!</strong> {{Session::get('danger')}}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mt-4">
                                            <div class="highlight-box">
                                                <div class="download">
                                                    <div class="dwnld_block">
                                                        @guest
                                                       <!--  <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#paperaccess"><i class="fa fa-file-pdf-o fa-lg"></i> Download
                                                        </button> -->
                                                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
                                                        
                                                        @else
                                                        @if($article->user_id == Auth::user()->id)
                                                        <a href="{{asset('volume/'.$volume->cat_folder.'/'.$volume->volume.'/'.$volume->issue.'/'.$article->pdf)}}" target="_blank">Download</a>
                                                        @else
                                                        <button type="button" class="btn btn-xs btn-link" data-toggle="modal" data-target="#paperaccess">Download</button>
                                                        @endif
                                                        @endguest
                                                        <span> 
                                                            @if($article->special_issue == 1)
                                                            [
                                                            <span class="text-warning font-weight-bold">This article belongs to Special Issue {{ $article->created_at->format('Y') }}</span>
                                                            ]
                                                            @else
                                                            [This article belongs to Volume - {{$volume->volume}}, Issue - {{$volume->issue}}]
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-2 ">
                                                <div>
                                                    <div class="col-md-12 pt-2 pb-3">
                                                        <div class="">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <strong>Title </strong>:
                                                                    <a class="text-black" onclick="view_count_submit('<?php echo $article->id;?>')" href="{{ route('single_article',$article->title_slug) }}">
                                                                        <span>{{  $article->ptitle}}</span>
                                                                    </a>
                                                           </div>
                                                       </div><br>


                                                       <div class="abstract-div">
                                                        <div class="abstract-cropped" style="display:block; text-align: justify;">
                                                            <strong>Abstract </strong>:
                                                            {{ $article->abstract }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    jQuery( function ( $ ) {
                        var $active = $( '#accordion .panel-collapse.in' ).prev().addClass( 'active' );
                        $active.find( 'a' ).append( '<span class="glyphicon glyphicon-minus pull-right"></span>' );
                        $( '#accordion .panel-heading' ).not( $active ).find( 'a' ).prepend( '<span class="glyphicon glyphicon-plus pull-right"></span>' );
                        $( '#accordion' ).on( 'show.bs.collapse', function ( e ) {
                            $( '#accordion .panel-heading.active' ).removeClass( 'active' ).find( '.glyphicon' ).toggleClass( 'glyphicon-plus glyphicon-minus' );
                            $( e.target ).prev().addClass( 'active' ).find( '.glyphicon' ).toggleClass( 'glyphicon-plus glyphicon-minus' );
                        } );
                        $( '#accordion' ).on( 'hide.bs.collapse', function ( e ) {
                            $( e.target ).prev().removeClass( 'active' ).find( '.glyphicon' ).removeClass( 'glyphicon-minus' ).addClass( 'glyphicon-plus' );
                        } );
                    } );

                </script>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>


<style>
    .access{
        font-size: 12px;
        color: #136753;
    }
</style>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- 
<div class="modal fade" id="paperaccess">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Download Info</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5 border-right">
                        <h6>Paper Access Key</h6>
                        <hr>
                        <form action="{{ route('get_paper_access_key') }}" method="GET">
                            @csrf
                            <input type="hidden" name="article_id" value="{{$article->id}}">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Access Key</label>
                                <div class="col-sm-8">
                                  <input type="text" name="access_key" placeholder="Access Key" class="form-control form-control-sm">
                              </div>

                              <div class="col-md-12">
                                <button type="submit" class="btn btn-sm btn-success float-right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-7">
                    <h6>No Access Key (<span class="access">Request for Download</span>)</h6>

                    <hr>
                    <form action="{{ route('send_request') }}" method="POST">
                        @csrf
                        <input type="hidden" name="article_id" value="{{$article->id}}">
                        @guest
                        <input type="hidden" name="authId" value="">
                        @else
                        <input type="hidden" name="authId" value="{{$article->id}}">
                        @endguest
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                              <input type="text" name="name" placeholder="Name" class="form-control form-control-sm">
                          </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" name="email" placeholder="Email" class="form-control form-control-sm">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Country</label>
                    <div class="col-sm-10">
                      <input type="text" name="inputcountryname" placeholder="Country Name" class="form-control form-control-sm">
                  </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-sm btn-info float-right">Send Request</button>
              </div>
          </div>
      </form>
  </div>
</div>
</div>
</div>
</div>
</div> -->
@endsection
