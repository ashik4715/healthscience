@extends('author.layouts.app')

@section('title', 'New Submission')

@push('css')

@endpush

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="well box box-primary" style="background: #f5f5f5 !important; border: 0px solid #e3e3e3 !important;">
            <div class="box-header with-border">
              <h3 class="box-title">SDIP-Submit Manuscript/Paper</h3>
            </div>
            <div class="_container">
                <form class="well _form-horizontal" action="{{route('author.paper-submission.store')}}" method="post" enctype="multipart/form-data" style="border: 0px solid #e3e3e3 !important;">
                    @csrf
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Manuscript/Paper Type <span style="color: red">*</span></label>
                                    <select class="selectpicker form-control" name="type_id">
                                        <option>A really long option to push the menu over the edget</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Branch/Journal<span style="color: red">*</span></label>
                                    <select class="selectpicker form-control" name="journal_id">
                                        <option>A really long option to push the menu over the edget</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Area of Research<span style="color: red">*</span></label>
                                    <input id="aresearch" name="aresearch" placeholder="Area of Research" class="form-control" required="true" value="" type="text">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Paper Title<span style="color: red">*</span></label>
                                    <input id="ptitle" name="ptitle" placeholder="Manuscript/Paper Title" class="form-control" required="true" type="text">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Doc File<span style="color: red">*</span></label>
                                     <div class="">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-paperclip"></i></span>
                                            <input id="docx" name="docx" class="form-control" required="true" type="file">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">PDF File<span style="color: red">*</span></label>
                                     <div class="">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-paperclip"></i></span>
                                            <input id="pdf" name="pdf" class="form-control" required="true" type="file">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="checkbox">
                            <label><input type="checkbox"> Check me out</label>
                        </div>
                    </div>
                    <div class="box-footer">
                       <input type="submit" class="btn btn-md btn-primary pull-right">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')

@endpush