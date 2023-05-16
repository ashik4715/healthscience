@extends('admin.layouts.app')

@section('title', 'Submission Details')

@push('css')
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <div class="tab-content">
                    <!-- /.tab-pane -->
                    <div class="active tab-pane" id="timeline">
                        <!-- The timeline -->
                        <ul class="timeline timeline-inverse">
                            <!-- timeline time label -->

                            <li class="time-label">
                                <span class="bg-blue">
                                  Submit Paper Info
                                </span>
                            </li>

                            <li>
                                <i class="fa fa-circle"></i>

                                <div class="timeline-item">
                                    <h3 class="timeline-header no-border">
                                        <strong class="col-md-3 col-sm-2">Branch / Journal</strong> <button class="btn">{{ $paper->catName}}</button>
                                    </h3>
                                </div>
                            </li>
                            <li>
                                <i class="fa fa-circle"></i>

                                <div class="timeline-item">
                                    <h3 class="timeline-header no-border">
                                        <strong class="col-md-3 col-sm-2">Paper Type</strong> <button class="btn">{{$paper->type_id == 1 ? 'Research Article':''}}
                                            {{$paper->type_id == 2 ? 'Review Article':''}}
                                            {{$paper->type_id == 3 ? 'Abstract Article':''}}</button>
                                    </h3>
                                </div>
                            </li>
                            <li>
                                <i class="fa fa-circle"></i>

                                <div class="timeline-item">
                                    <h3 class="timeline-header no-border">
                                        <strong class="col-md-3 col-sm-2">Paper Title</strong> <button class="btn">{{$paper->ptitle}}</button>
                                    </h3>
                                </div>
                            </li>
                            <li>
                                <i class="fa fa-circle"></i>

                                <div class="timeline-item">
                                    <h3 class="timeline-header no-border row">
                                        <strong class="col-md-3 col-sm-2">Area of Research</strong>
                                        <button class="btn">{{$paper->aresearch}}</button>
                                    </h3>
                                </div>
                            </li>
                            <li>
                                <i class="fa fa-circle"></i>

                                <div class="timeline-item">
                                    <h3 class="timeline-header no-border row">
                                        <strong class="col-md-3 col-sm-2">Paper Issue</strong>
                                        <button class="btn">Volume. {{$paper->volumeno}}, Issue. {{$paper->issue}} - {{$paper->volume}}</button>
                                    </h3>
                                </div>
                            </li>

                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-circle"></i>

                                <div class="timeline-item">
                                    <h3 class="timeline-header">
                                        <strong>Abstract</strong></h3>

                                    <div class="timeline-body">
                                        {!! $paper->abstract !!}
                                    </div>
                                </div>
                            </li>

                            <li>
                                <i class="fa fa-circle"></i>

                                <div class="timeline-item">

                                    <h3 class="timeline-header"> <strong>Others Information</strong> </h3>

                                    <div class="timeline-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <strong>Number of Figures:</strong> <button class="btn">{{$paper->no_figures}}</button>
                                            </div>
                                            <div class="col-md-4">
                                                <strong>Number of Tables:</strong> <button class="btn">{{$paper->no_tables}}</button>
                                            </div>
                                            <div class="col-md-4">
                                                <strong>Number of Words:</strong> <button class="btn">{{$paper->no_words}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                            <!-- timeline time label -->
                            <li class="time-label">
                        <span class="bg-green">
                          Author
                        </span>
                            </li>
                            <li>
                                <div class="timeline-item">
                                    <h3 class="timeline-header"> <strong>Name of other Authors</strong></h3>
                                    <div class="timeline-body">
                                        @php
                                            $authors = json_decode($paper->author_name);
                                        @endphp
                                        @foreach ($authors as $key => $author)
                                            <button class="btn">{{$loop->index +1}}. {{$author}}</button>
                                        @endforeach
                                    </div>
                                </div>
                            </li>

                            <li class="time-label">
                            <span class="bg-green">
                              Funder
                            </span>
                            </li>
                            <li>
                                <div class="timeline-item">
                                    <h3 class="timeline-header"> <strong>Name of Funders</strong></h3>
                                    <div class="timeline-body">
                                        @php($funder_names = json_decode($paper->funder_name, true))
                                        @foreach ($funder_names as $funder_name)
                                            <button class="btn">{{$loop->index +1}}. {{$funder_name['funder_name']}} ({{$funder_name['funder_gant_no']}})</button>
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                            <li class="time-label">
                            <span class="bg-green">
                              Keyword
                            </span>
                            </li>
                            <li>
                                <div class="timeline-item">
                                    <div class="timeline-body">
                                        @php($paper_tags = json_decode($paper->paper_tags))
                                        @foreach ($paper_tags as $paper_tag)
                                            <button class="btn btn-xs {{$loop->index % 2 == 0? 'btn-primary':'btn-danger'}}">{{$paper_tag}}</button>
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                            <li class="time-label">
                                <span class="bg-green">
                                  Document / File
                                </span>
                            </li>
                            <li>
                                <i class="fa fa-file bg-purple"></i>

                                <div class="timeline-item">

                                    <h3 class="timeline-header"> <strong>Uploaded Document / File</strong> </h3>

                                    <div class="timeline-body text-center">
                                        <a href="{{asset('volume/'.$paper->cat_folder.'/'.$paper->volume.'/'.$paper->issue.'/'.$paper->docx)}}" target="_blank">
                                            <img src="{{asset('images/docx.png')}}" alt="..." class="mr-5" width="100" height="100" style="margin-right: 20px;">
                                        </a>
                                        <a href="{{asset('volume/'.$paper->cat_folder.'/'.$paper->volume.'/'.$paper->issue.'/'.$paper->pdf)}}" target="_blank">
                                            <img src="{{asset('images/pdf.png')}}" alt="..." class="margin" width="100" height="100">
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>


@endsection

@push('scripts')

@endpush
