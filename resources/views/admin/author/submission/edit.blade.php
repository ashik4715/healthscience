@extends('admin.layouts.app')

@section('title', 'Edit Author Submission')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="well box box-primary" style="background: #f5f5f5 !important; border: 0px solid #e3e3e3 !important;">
                <div class="box-header with-border">
                    <h3 class="box-title">IMJ-Submit Manuscript/Paper</h3>
                </div>
                <div class="_container">
                    <form class="well _form-horizontal" action="{{route('admin.author-submission.update', $submit->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
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
                                            {{--                                            <option>Select Manuscript/Paper Type</option>--}}
                                            <option value="1" {{$submit->type_id == 1 ? 'selected':''}}>Research Article</option>
                                            <option value="2" {{$submit->type_id == 2 ? 'selected':''}}>Review Article</option>
                                            <option value="3" {{$submit->type_id == 3 ? 'selected':''}}>Abstract Article</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Branch/Journal<span style="color: red">*</span></label>
                                        <select class="selectpicker form-control" name="journal_id">
                                            {{--                                            <option>Select Branch/Journal</option>--}}
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{$category->id == $submit->catId ? 'selected':''}}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Area of Research<span style="color: red">*</span></label>
                                        <input id="aresearch" name="aresearch" class="form-control" required="true" value="{{$submit->aresearch}}" type="text">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Paper Title<span style="color: red">*</span></label>
                                        <input id="ptitle" name="ptitle" class="form-control" required="true" type="text" value="{{$submit->ptitle}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Abstract<span style="color: red">*</span></label>
                                    </div>
                                    <textarea name="abstract" rows="10" style="-webkit-box-sizing:border-box;-moz-box-sizing: border-box;box-sizing: border-box;width: 100%;" >{!! $submit->abstract !!}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        @php
                                            $vol_issue = \App\Models\Submission_timer::find($submit->issue_id);
                                            $authors = json_decode($submit->author_name);
                                        @endphp

                                        <div class="col-md-6">
                                            <div id="author_name_add">
                                                @foreach ($authors as $key => $author)
                                                    <div class="form-group">
                                                        @if( $loop->index==0 )
                                                            <label class="control-label">(Minimum 1 Author Required)<span style="color: red">*</span></label>
                                                            <input id="author_name1" name="author_name[]" value="{{ $author }}" placeholder="Author Name" class="form-control" type="text">
                                                        @else
                                                            <label class="control-label">Name of Author {{$loop->index+1}}</label>
                                                            <input name="author_name[]" value="{{ $author }}" placeholder="Author Name" class="form-control" type="text">
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                            <a class="btn btn-default" onclick="add_new_author()">Add New Author</a>
                                        </div>
                                       

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Doc File(Only .doc and .docx file allowed)<span style="color: red">*</span></label>
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-paperclip"></i></span>
                                                            <input id="docx" name="docx" onchange="docx_validation(event)" class="form-control" type="file">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                <span>
                                                    <a class="btn btn-sm btn-primary" href="{{ asset('volume/'.$submit->cat_folder.'/'.$submit->volume.'/'.$submit->issue.'/'.$submit->docx) }}">
                                                        View DOC <i class="fa fa-eye"></i>
                                                    </a>
                                                </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label text-danger">Only view. You can't change the pdf file.(N.B Admin can Change)</label>
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-paperclip"></i></span>
                                                            <input id="pdf" name="pdf" onchange="pdf_validation(event)" class="form-control" type="file">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                <span>
                                                    <a class="btn btn-sm btn-primary" href="{{ asset('volume/'.$submit->cat_folder.'/'.$submit->volume.'/'.$submit->issue.'/'.$submit->pdf) }}">
                                                        View PDF <i class="fa fa-eye"></i>
                                                    </a>
                                                </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label text-danger">You can't change Publication Issue</label>
                                                <input id="issue_id" name="issue_id"  class="form-control" value="{{$submit->issue_id}}" type="hidden">
                                                <div class="form-group">
                                                    <input placeholder="Volume - {{$vol_issue->volume}} Issue -{{$vol_issue->issue}}(Can not be change on Edit)" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <h3 class="text-red"><input name="special_issue" value="1" type="checkbox"  {{$submit->special_issue == 1 ? 'checked':''}}>This Paper Under Special Issue</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <hr>


                            <div class="row">
                                <div class="col-md-12">
                                    <label>Keywords (Minimum 1 and maximum 5 Keywords Required) <span style="color: red">*</span></label>
                                    @php($tags = json_decode($submit->paper_tags))
                                    <div id="all_tags" style="margin-bottom: 5px;"></div>
                                    <div class="form-group">
                                        <select id="select_Keywords" class="form-control select2 select2-hidden-accessible" onclick="_select_this_checkbox(this)" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                            <option>Add Keywords</option>
                                        </select>
                                    </div>
                                    <textarea id="all_ids" name="paper_tags" class="form-control" rows="2" style="display:none;"></textarea>
                                </div>
                            </div>

                            <!-- <hr> -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Funding</label>
                                    </div>
                                    <label class="radio-inline">
                                        <input type="radio" id="funding_yes" name="optradio" checked>Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" id="funding_no" name="optradio">No
                                    </label>
                                </div>

                                <div class="col-md-12" id="funder_div" style="display: ;"><br>
                                    <div class="form-group">
                                        <label class="control-label">Funders</label>
                                        <table class="table table-striped">
                                            <tbody>
                                            <tr>
                                                <th>SL</th>
                                                <th>Name</th>
                                                <th>GRANT / AWARD NUMBER</th>
                                            </tr>
                                            @php($funder = json_decode($submit->funder_name))
                                            <tr>
                                                <td>1.</td>
                                                <td>
                                                    <input id="funder_name1" name="funder_name1" value="{{$funder[0]->funder_name}}" placeholder="Funder Name 1" class="form-control" type="text">
                                                </td>
                                                <td>
                                                    <input id="funder_gant_no1" name="funder_gant_no1" value="{{$funder[0]->funder_gant_no}}" placeholder="funder gant no 1" class="form-control" type="number">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>
                                                    <input id="funder_name2" name="funder_name2" value="{{$funder[1]->funder_name}}" placeholder="Funder Name 2" class="form-control" type="text">
                                                </td>
                                                <td>
                                                    <input id="funder_gant_no2" name="funder_gant_no2" value="{{$funder[1]->funder_gant_no}}" placeholder="funder gant no 2" class="form-control" type="number">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3.</td>
                                                <td>
                                                    <input id="funder_name3" name="funder_name3" value="{{$funder[2]->funder_name}}" placeholder="Funder Name 3" class="form-control" type="text">
                                                </td>
                                                <td>
                                                    <input id="funder_gant_no3" name="funder_gant_no3" value="{{$funder[2]->funder_gant_no}}" placeholder="funder gant no 3" class="form-control" type="number">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Manuscript Information</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Number of Figures (if not applicable please fill up by 0) <span style="color: red">*</span></label>
                                        <input id="no_figures" name="no_figures" placeholder="Number of Figures" value="{{$submit->no_figures}}" class="form-control" type="number">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Number of Tables (if not applicable please fill up by 0) <span style="color: red">*</span></label>
                                        <input id="no_tables" name="no_tables" placeholder="Number of Tables" value="{{$submit->no_tables}}" class="form-control" type="number">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Number of Words (if not applicable please fill up by 0) <span style="color: red">*</span></label>
                                        <input id="no_words" name="no_words" placeholder="Number of Words" value="{{$submit->no_words}}" class="form-control" type="number">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Confirmation the Following</label>
                                        <div class="checkbox" style="margin: 0px 0px 10px 0px;">
                                            <label><input name="terms_and_condition" value="1" type="checkbox" {{$submit->terms_and_condition == 1 ? 'checked':''}} required>Terms & Condition <span style="color: red">*</span></label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input name="agreement" value="1" type="checkbox"  {{$submit->agreement == 1 ? 'checked':''}} required>Agreement <span style="color: red">*</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <input type="submit" class="btn btn-md btn-primary pull-right">
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>



    @if($submit->status == 1)
        <div class="row">
            <div class="col-md-12">
                <div class="well box box-primary" style="background: #f5f5f5 !important; border: 0px solid #e3e3e3 !important;">
                    <div class="box-header with-border">
                        <h3 class="box-title">Uploaded Agreement Paper and Payment Slip</h3>
                    </div>
                    <div class="_container">
                        <div class="box-body">
                            <div class="row">
                                @php( $pay_agreement = \App\Models\Payagreement::where('submit_id', $submit->id)->first())
                                @if(isset($pay_agreement))
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Agreement Paper Scan Copy</label>
                                            <div class="text-center" style="padding: 10px 0px; background-color: #ecf0f5 !important; border: 1px solid #5b735f !important;">
                                                <i class="fa fa-handshake-o" style="font-size:50px;color: #5c7360;"></i> <br>
                                                <a class="btn btn-xs btn-primary" target="_blank" href="{{ asset('payagreementpaper/'.$pay_agreement->agreement) }}">
                                                    Agreement View <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Bank Payment Document</label>
                                            @if($pay_agreement->payment == null)
                                                <div class="alert-warning" style="padding: 15px 10px;">
                                                    <h4 class="text-center">
                                                        Author Not pay By Bank
                                                    </h4>
                                                </div>
                                            @else
                                                <div class="text-center" style="padding: 10px 0px; background-color: #ecf0f5 !important; border: 1px solid #5b735f !important;">
                                                    <i class="fa fa-money" style="font-size:50px;color: #5c7360;"></i> <br>
                                                    <a class="btn btn-xs btn-primary" target="_blank" href="{{ asset('payagreementpaper/'.$pay_agreement->payment) }}">
                                                        Payment View <i class="fa fa-eye"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="alert-warning" style="padding: 15px 10px; background-color: #ecf0f5 !important; border: 1px solid red !important;">
                                                <h4 class="text-center text-red">
                                                    Author Not Submitted Agreement Paper !
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="well box box-primary" style="background: #f5f5f5 !important; border: 0px solid #e3e3e3 !important;">
                    <h3 class="text-center">Upload Agreement Paper and Payment Slip Section</h3>
                    <p class="text-center">(N.B Show Upload Option if Payment Completed)</p>
                </div>
            </div>
        </div>
    @endif


@endsection

@push('scripts')
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.js')}}"></script>

    <script>
        function add_new_author() {
            var count = $('#author_name_add .form-group').length+1;
            var html = '';
                html += '<div class="form-group">'
                    html += '<label class="control-label">Name of Author '+ count +'</label>'
                    html += '<input  name="author_name[]" placeholder="Author Name '+ count +'" class="form-control" value="" type="text">'
                html += ' </div>'
            $('#author_name_add').append(html);
        }
    </script>

    <script>

        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        })

        $("#funding_yes").click(function(){
            $("#funder_div").show();
        });

        $("#funding_no").click(function(){
            $("#funder_div").hide();
        });
    </script>

    <script type="text/javascript">


        var checkbox_arr = [];

        $(function(){
            var exTags = '<?php echo json_encode($tags) ?>';
            $('#all_ids').html(exTags);
            var all_ids = JSON.parse($('#all_ids').html());
            for (var i=0; i<all_ids.length; i++){

                var  apend = '<span class="tag_'+all_ids[i]+'" style="font-size: 16px;font-weight: 500;color: #4d7941; margin-left:5px;     margin-right: 10px;position: relative" class=""><span style="background-color: #3c8dbc;border-color: #367fa9;padding: 1px 10px;color: #fff;">'+all_ids[i]+'</span><sup class="" style="color: #463e3e;font-size: 20px;cursor: pointer;position: absolute;top: -5px;right: -5px;background-color: #afafaf;padding: 6px 1px; border-radius: 4px;" onclick="remove_tag(\'' + all_ids[i] + '\')">×</sup></span>'
                $("#all_tags").append(apend);
            }

            checkbox_arr.push(all_ids);

        });

        $('#select_Keywords').change(function() {
            var all_ids = $('#all_ids').html();
            var tags = JSON.parse(all_ids);
            var tag  = this.value;
            if (all_ids.indexOf(tag) == -1) {
                tags.push(tag);
                var  apend = '<span class="tag_'+this.value+'" style="font-size: 16px;font-weight: 500;color: #4d7941; margin-left:5px;     margin-right: 10px;position: relative" class=""><span style="background-color: #3c8dbc;border-color: #367fa9;padding: 1px 10px;color: #fff;">'+this.value+'</span><sup class="" style="color: #463e3e;font-size: 20px;cursor: pointer;position: absolute;top: -5px;right: -5px;background-color: #afafaf;padding: 6px 1px; border-radius: 4px;" onclick="remove_tag(\'' + this.value + '\')">×</sup></span>'
                $("#all_tags").append(apend);
            }
            var arr = JSON.stringify(tags);
            $('#all_ids').html(arr);
        });



        function add_new_tag(){
            var  new_tag = $('.select2-search__field').val()
            var all_ids = $('#all_ids').html();


            var tags = JSON.parse(all_ids);


            if (all_ids.indexOf(new_tag) == -1) {
                tags.push(new_tag);
                var  apend = '<span class="tag_'+new_tag+'" style="font-size: 16px;font-weight: 500;color: #4d7941; margin-left:5px;     margin-right: 10px; position: relative" class=""><span style="background-color: #3c8dbc;border-color: #367fa9;padding: 1px 10px;color: #fff;">'+new_tag+'</span><sup class="" style="color: #463e3e;font-size: 20px;cursor: pointer;position: absolute;top: -5px;right: -5px;background-color: #afafaf;padding: 6px 1px; border-radius: 4px;" onclick="remove_tag(\'' + new_tag + '\')">×</sup></span>'
                $("#all_tags").append(apend);
                $('#add_new_tag').val('')
            }
            var arr = JSON.stringify(tags);


            $('#all_ids').html(arr);
            $('.select2-search__field').val('')
        }

        function remove_tag(me){
            var all_ids = $('#all_ids').html();
            var arr = JSON.parse( all_ids );

            var index = arr.indexOf(me);
            if (index != -1) {
                arr.splice(index, 1);
            }

            var arr = JSON.stringify( arr );
            $('#all_ids').html(arr);
            $(".tag_"+me).remove();
            console.log($('#all_ids').html())
            if( $('#all_ids').html() == '[]'){
                checkbox_arr = []
                arr = [];
                $('#all_tags').html('');
                $('#all_ids').html('[]');
            }
            console.log(checkbox_arr);
        }

    </script>
@endpush
