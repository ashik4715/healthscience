@extends('author.layouts.app')

@section('title', 'Edit Submission')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="well box box-primary" style="background: #f5f5f5 !important; border: 0px solid #e3e3e3 !important;">
                <div class="box-header with-border">
                    <h3 class="box-title">International Medical Journal-Submit Manuscript/Paper <botton id="show_submit_condition_btn" class="btn btn-xs btn-primary">Submit Condition <i class="fa fa-eye"></i> </botton></h3>
                    <div class="col-md-12 well show_submit_condition_div" style="margin-top: 25px; ;padding: 10px 50px;background-color: #ecf0f5 !important;border: 1px solid #5b735f !important; display: none;">
                        <h4>1. <span style="color: #963f3f;">Please make sure your paper is one column format like International Medical Journal paper format.</span></h4>
                        <h4>2. <span style="color: #963f3f;">Please make sure you submit both the .doc/.docx and PDF Article into your Author's Dashboard.</span></h4>
                        <h4>3. <span style="color: #963f3f;">Please make sure your paper has accurate 11 (times new roman) font and single line spacing.</span></h4>
                        <h4>4. <span style="color: #963f3f;">Please make sure you write your Reference (Times new roman 10 font) correctly According to International Medical Journal
                            Instructions or follow APA format for Reference</span></h4>
                        <h4 class="text-red" style="margin-top: 10px;">Notice : <br>
                            <h4>1. <span style="color: #963f3f;">Payment Button will open as soon as your paper is accepted. The status of
                                    the paper will show accepted and you have to click on "pay now" Button. After that payment page will open.</span> </h4>
                            <h4>2. <span style="color: #963f3f;">You can use your Author's Account to Submit multiple article.</span></h4>
                        </h4>
                    </div>
                </div>
                <div class="_container">
                    <form class="well _form-horizontal" onsubmit="return validateSubmitForm()" action="{{route('author.paper-submission.update', $submit->id)}}" method="post" enctype="multipart/form-data">
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
                                            <option value="1" {{$submit->type_id == 1 ? 'selected':''}}>Research Article</option>
                                            <option value="2" {{$submit->type_id == 2 ? 'selected':''}}>Review Article</option>
                                            <option value="3" {{$submit->type_id == 3 ? 'selected':''}}>Abstract Article</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label text-danger">You can't change Journal Name</label>
                                        @php
                                            $category = \App\Models\Category::find($submit->catId)
                                        @endphp
                                        <input type="hidden" class="form-control" name="journal_id" value="{{$category->id}}" readonly>
                                        <input class="form-control"  placeholder="{{$category->name}}" disabled>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Area of Research (Maximum 5 Attributes)<span style="color: red">*</span></label>
                                        <input id="aresearch" maxlength="120" name="aresearch" class="form-control"  value="{{$submit->aresearch}}" type="text">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Paper Title<span style="color: red">*</span></label>
                                        <input id="ptitle" name="ptitle" class="form-control"  type="text" value="{{$submit->ptitle}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Abstract (Maximum 250 Words)<span style="color: red">*</span></label>
                                    </div>
                                    <textarea id="abstract" name="abstract" maxlength="1500" class="pull-left" rows="10" style="-webkit-box-sizing:border-box;-moz-box-sizing: border-box;box-sizing: border-box;width: 100%;" >{!!$submit->abstract!!}</textarea>
                                </div>
                            </div>
                            <hr>
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
                                                    <input id="docx" name="docx" onchange="docx_validation(event)" class="form-control" type="file" style="z-index: 0;">
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
                                        <label class="control-label text-danger">Only view. You can't change the pdf file.</label>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-paperclip"></i></span>
                                                    <input id="pdf" name="pdf" onchange="pdf_validation(event)" class="form-control" type="file" disabled style="z-index: 0;">
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
                                </div>
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
                            <hr>
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
                                                <th>GRANT(US $) </th>
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
                                        <label class="control-label">Number of Words (Not more than 6000 words) <span style="color: red">*</span></label>
                                        <input id="no_words" name="no_words" placeholder="Number of Words" value="{{$submit->no_words}}" class="form-control" type="number">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Confirmation the Following</label>
                                        <div class="checkbox" style="margin: 0px 0px 10px 0px;">
                                            <label>
                                                <input id="terms_and_condition" name="terms_and_condition" value="1" type="checkbox" {{$submit->terms_and_condition == 1 ? 'checked':''}}>I have read the <a href="{{route('terms_condition')}}" target="_blank">Terms & Condition</a> <span style="color: red">*</span> <span style="color: red" id="terms_and_condition_checked" class="hidden">Please Checked This checkbox</span>
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input id="agreement" name="agreement" value="1" type="checkbox"  {{$submit->agreement == 1 ? 'checked':''}}>I accept the <a href="{{ asset('CopyrightAgreementForm.pdf') }}" target="_blank"> Agreement</a><span style="color: red">*</span> <span id="agreement_checked" class="hidden" style="color: red">Please Checked This checkbox</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="" class="btn btn-danger pull-right"><i class="fa fa-arrow-circle-left"></i> Back</a>
                                        <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-refresh"></i> Update</button>
                                    </div>
                                </div>
                            </div>
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
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
                    @php( $pay_agreement = \App\Models\Payagreement::where('submit_id', $submit->id)->first())
                    @if(isset($pay_agreement) && $pay_agreement->update_count < 1)
                            <div class="box-header with-border">
                                <h3 class="box-title">Edit Agreement Paper @if($pay_agreement->payment != null ) and Payment Slip @endif</h3>
                            </div>
                            <div class="_container">
                                <form class="well _form-horizontal" action="{{route('author.editpayagreement')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Agreement Paper Upload (<span class="text-danger">.pdf, .jpg, .jpeg, .png</span>)<span style="color: red">*</span></label>
                                                    <div class="">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-paperclip"></i></span>
                                                            <input id="docx" name="agreement" class="form-control" type="file">
                                                        </div>
                                                        <span>
                                                            <a class="btn btn-xs btn-primary" href="{{ asset('payagreementpaper/'.$pay_agreement->agreement) }}" target="_blank">
                                                                Agreement View <i class="fa fa-eye"></i>
                                                            </a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                        {{--//  problem here--}}
                                            <div class="col-md-6">
                                                @if($pay_agreement->payment != null )
                                                    <div class="form-group">
                                                        <label class="control-label">Payment Document Scan Copy (<span class="text-danger">.pdf, .jpg, .jpeg, .png</span>)<span style="color: red">*</span></label>
                                                        <div class="">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-paperclip"></i></span>
                                                                <input id="docx" name="payment" class="form-control" type="file">
                                                            </div>
                                                            <span>
                                                        @if($pay_agreement->payment != null)
                                                            <a class="btn btn-xs btn-primary" target="_blank" href="{{ asset('payagreementpaper/'.$pay_agreement->payment) }}">
                                                                Payment View <i class="fa fa-eye"></i>
                                                            </a>
                                                        @endif
                                                    </span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" value="{{$submit->id}}" name="submit_id">
                                        <button type="submit" class="btn btn-md btn-primary pull-right"><i class="fa fa-edit"></i> Edit</button>
                                    </div>
                                </form>
                            </div>
                    @elseif(isset($pay_agreement) && $pay_agreement->update_count == 1)
                        <div class="text-center">
                            <h4 class="text-danger">You can't edit your Agreement Paper and Payment Reciept more time.</h4> If you have any problem please email to support@seronijihou.com with details.
                            <br>
                            <br>
                            <a href="{{asset('payagreementpaper/'.$pay_agreement->agreement)}}" target="_blank" class="btn btn-md btn-info"><i class="fa fa-eye"></i> Agreement Paper</a>
                            <a href="{{asset('payagreementpaper/'.$pay_agreement->payment)}}" target="_blank" class="btn btn-md btn-info"><i class="fa fa-eye"></i> Payment Reciept</a>

                        </div>
                    @else
                        <div class="box-header">
                            <h3 class="box-title">Upload Agreement Paper @if($submit->is_payment == 0)and Payment Slip @endif</h3>
                        </div>
                        <div>

                            <form class="well form-horizontal" action="{{route('author.payagreement')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="box-body">
                                    <div class="row">
                                        @if($submit->is_payment == 0)
                                            <div class="callout callout-warning">
                                                <h4>Be confirm your payment!</h4>
                                                <p>If you have any online payment or have international debit/credit card please pay first then upload agreement paper. If you didn't have then upload your bank payment slip.</p>
                                            </div>
                                        @endif
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Agreement Paper Upload (<span class="text-danger">.pdf, .jpg, .jpeg, .png</span>)<span style="color: red">*</span></label>
                                                <div class="">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-paperclip"></i></span>
                                                        <input id="docx" name="agreement" class="form-control" type="file">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            @if($submit->is_payment == 0)
                                                <div class="form-group">
                                                    <label class="control-label">Bank Payment Document Scan Copy (<span class="text-danger">.pdf, .jpg, .jpeg, .png</span>)<span style="color: red">*</span></label>
                                                    <div class="">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-paperclip"></i></span>
                                                            <input id="docx" name="payment" class="form-control" type="file">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="hidden" value="{{$submit->id}}" name="submit_id">
                                    <button type="submit" class="btn btn-md btn-primary pull-right"><i class="fa fa-upload"></i> Upload</button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="well box box-primary" style="background: #f5f5f5 !important; border: 0px solid #e3e3e3 !important;">
                    <h3 class="text-center">Upload Agreement Paper and Bank Payment Slip Section (If Bank Payment)</h3>
                    <p class="text-center">(N.B Show Upload Option if Paper is Accepted)</p>
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
        $("#show_submit_condition_btn").click(function(){
            $('.show_submit_condition_div').slideToggle();
        });
        // ======================== Validation Start ================================
    $(document).ready(function() { 
        $("#cate_id_selector").change(function() { 
            if ($(this).val() != "") {
                $(this).css({"border-color": "green", "border-width":"1px", "border-style":"solid"});
            }else{
                $(this).css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            }
        });
        $("#aresearch").keyup(function() { 
            if ($(this).val() != "") {
                $(this).css({"border-color": "green", "border-width":"1px", "border-style":"solid"});
            }else{
                $(this).css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            }
        }); 
        $("#ptitle").keyup(function() { 
            if ($(this).val() != "") {
                $(this).css({"border-color": "green", "border-width":"1px", "border-style":"solid"});
            }else{
                $(this).css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            }
        }); 
        $("#abstract").keyup(function() { 
            if ($(this).val() != "") {
                $(this).css({"border-color": "green", "border-width":"1px", "border-style":"solid"});
            }else{
                $(this).css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            }
        }); 
        $("#author_name1").keyup(function() { 
            if ($(this).val() != "") {
                $(this).css({"border-color": "green", "border-width":"1px", "border-style":"solid"});
            }else{
                $(this).css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            }
        }); 
    
        $("#terms_and_condition").change(function() { 
             if ($("#terms_and_condition").prop("checked") == false) {
                $("#terms_and_condition_checked").removeClass('hidden');
            }else{
                $("#terms_and_condition_checked").addClass('hidden');
            }
            
        });
        $("#agreement").change(function() { 
             if ($("#agreement").prop("checked") == false) {
                $("#agreement_checked").removeClass('hidden');
            }else{
                $("#agreement_checked").addClass('hidden');
            }
        });
        // var keyword = $('#all_ids').val();
        // if (keyword == "") {
        //     var error = '<span style="color: red">Keywords(Minimum 1 and maximum 5 Keywords Required) !</span>'
        //     Swal.fire(error);
        //     $(".select2-selection--single").focus();
        //     $(".select2-selection--single").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
        //     return false;
        // }
    }); 
    
    function validateSubmitForm() {

        if ($('#cate_id_selector').val() == "") {

            $("#cate_id_selector").focus();
            $("#cate_id_selector").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;

        }else if($('#aresearch').val() == ""){

            $("#aresearch").focus();
            $("#aresearch").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;

        }else if($('#ptitle').val() == ""){

            $("#ptitle").focus();
            $("#ptitle").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;

        }else if($('#abstract').val() == ""){

            $("#abstract").focus();
            $("#abstract").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;

        }else if($('#author_name1').val() == ""){

            $("#author_name1").focus();
            $("#author_name1").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;

        }else if($('#select_issue_id').val() == ""){

            $("#select_issue_id").focus();
            $("#select_issue_id").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;

        }else if($('#all_ids').val() == "" || $('#all_ids').val() == '[]'){

            $(".select2-selection--single").focus();
            $(".select2-selection--single").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;

        }else if($("#terms_and_condition").prop("checked") == false){

            $("#terms_and_condition").focus();
            $("#terms_and_condition_checked").removeClass('hidden');
            return false;

        }else if($("#agreement").prop("checked") == false){

            $("#agreement").focus();
            $("#agreement_checked").removeClass('hidden');
            return false;

        }else if($('#all_ids').val() == "") {

            var error = '<span style="color: red">Keywords(Minimum 1 and maximum 5 Keywords Required) !</span>'
            Swal.fire(error);
            $(".select2-selection--single").focus();
            $(".select2-selection--single").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;

        }else{

            show_loader_div('Paper is Updating. Please Wait for while. might take few minutes..')
            return true;
        }
    }

    function docx_validation(event){
        if (!event || !event.target || !event.target.files || event.target.files.length === 0) {
            return;
        }
        const docx_name = event.target.files[0].name;
        const docx_lastDot = docx_name.lastIndexOf('.');
        const docx_ext = docx_name.substring(docx_lastDot + 1);
        if (docx_ext == 'docx' || docx_ext == 'doc'){
            console.log(docx_ext);
        } else{
            $('#docx').val('')
            var error = '<span style="color: red">Only ( .docx or .doc ) format are Allowed !</span>'
            Swal.fire(error);
        }
    }

    function pdf_validation(event){
        if (!event || !event.target || !event.target.files || event.target.files.length === 0) {
            return;
        }
        const pdf_name = event.target.files[0].name;
        const pdf_lastDot = pdf_name.lastIndexOf('.');
        const pdf_ext = pdf_name.substring(pdf_lastDot + 1);
        if (pdf_ext == 'pdf' || pdf_ext == 'PDF'){
            console.log(pdf_ext);
        }else {
            $('#pdf').val('')
            var error = '<span style="color: red">Only ( .pdf ) format is Allowed !</span>'
            Swal.fire(error);
        }
    }
    // =========================== Validation End ================================

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
                if (tags.length<5) {
                    tags.push(tag);
                    var apend = '<span class="tag_' + this.value + '" style="font-size: 16px;font-weight: 500;color: #4d7941; margin-left:5px;     margin-right: 10px;position: relative" class=""><span style="background-color: #3c8dbc;border-color: #367fa9;padding: 1px 10px;color: #fff;">' + this.value + '</span><sup class="" style="color: #463e3e;font-size: 20px;cursor: pointer;position: absolute;top: -5px;right: -5px;background-color: #afafaf;padding: 6px 1px; border-radius: 4px;" onclick="remove_tag(\'' + this.value + '\')">×</sup></span>'
                    $("#all_tags").append(apend);
                }else{
                    var error = '<span style="color: red">Maximum 5 Keywords are Allowed !!</span>'
                    Swal.fire(error);
                }
            }
            var arr = JSON.stringify(tags);
            $('#all_ids').html(arr);
        });

        function add_new_tag(){
            var  new_tag = $('.select2-search__field').val()
            var all_ids = $('#all_ids').html();
            var tags = JSON.parse(all_ids);

            if (all_ids.indexOf(new_tag) == -1) {
                if (tags.length<5) {
                    tags.push(new_tag);
                    var apend = '<span class="tag_' + new_tag + '" style="font-size: 16px;font-weight: 500;color: #4d7941; margin-left:5px;     margin-right: 10px; position: relative" class=""><span style="background-color: #3c8dbc;border-color: #367fa9;padding: 1px 10px;color: #fff;">' + new_tag + '</span><sup class="" style="color: #463e3e;font-size: 20px;cursor: pointer;position: absolute;top: -5px;right: -5px;background-color: #afafaf;padding: 6px 1px; border-radius: 4px;" onclick="remove_tag(\'' + new_tag + '\')">×</sup></span>'
                    $("#all_tags").append(apend);
                    $('#add_new_tag').val('')
                }else{
                    var error = '<span style="color: red">Maximum 5 Keywords are Allowed !!</span>'
                    Swal.fire(error);
                }
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
            console.log('me')
            console.log(me)
            console.log($('#all_ids').html())
            if( $('#all_ids').html() == '[]'){
                checkbox_arr = []
                arr = [];
                $('#all_tags').html('');
                $('#all_ids').html('[]');
                var error = '<span style="color: red">Minimum 1 Keywords Required !!</span>'
                Swal.fire(error);
            }
        }


        $(function () {
            if ($('#issue_id').val() != ''){
                $('#select_issue_id').val('Volume -(Select Successfully)');
            }
            console.log($('#issue_id').val())
            console.log($('#select_issue_id').val())
        })
        $('#cate_id_selector').change(function () {

            var cate_id = this.value;
            $('#issue_id').val('');
            $('#select_issue_id').val('');
            $.ajax({
                url: "{{route('author.cate_id_selector')}}",
                method: "POST",
                dataType: "JSON",
                data: {cate_id:cate_id, _token: '{{csrf_token()}}'},
                success: function (data) {
                    console.log(data);
                    $('#issue_id').val(data.id);
                    // $('.select_issue_id_ok').css('display', 'block');
                    $('#select_issue_id').val('Volume -'+data.volume+' Issue -'+data.issue+'(Select Successfully)');
                },
                error: function() {
                    console.log(data);
                }
            });
        })
    </script>

    <script src="{{asset('admin/bower_components/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')}}"></script>

    <script type="text/javascript">
        $(function () {
            CKEDITOR.replace('abstract');
            // $('.textarea').wysihtml5();
        })
    </script>
@endpush
