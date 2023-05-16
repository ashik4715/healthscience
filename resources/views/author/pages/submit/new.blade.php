@extends('author.layouts.app')

@section('title', 'New Submission')

@push('css')
<link rel="stylesheet" href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
<style>
    .alert {
        padding: 5px;
        margin-bottom: 0px;
        border: 1px solid transparent;
        border-radius: 4px;
    }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body well">
                <div class="box-header">
                    <h3 class="box-title">International Medical Journal-Submit Manuscript/Paper. <botton id="show_submit_condition_btn" class="btn btn-xs btn-primary" style="display: none;" >Submit Condition <i class="fa fa-eye"></i> </botton></h3>
                    <div class="alert alert-warning text-center text-black h4 mb-0">N.B: If you are facing problem to submit your paper then please contact at <strong>support@seronijihou.com</strong></div>


                    <div class="col-md-12 well show_submit_condition_div" style="margin-top: 25px; ;padding: 10px 50px;background-color: #ecf0f5 !important;border: 1px solid #5b735f !important;">
                        <h4>1. <span style="color: #963f3f;">Please make sure your paper is one column format like International Medical Journal  paper format.</span></h4>
                        <h4>2. <span style="color: #963f3f;">Please make sure you submit both the .doc/.docx and PDF Article into your Author's Dashboard.</span></h4>
                        <h4>3. <span style="color: #963f3f;">Please make sure your paper has accurate 11 (times new roman) font and single line spacing.</span></h4>
                        <h4>4. <span style="color: #963f3f;">Please make sure you write your Reference (Times new roman 10 font) correctly According to International Medical Journal 's
                            Instructions or follow APA format for Reference</span></h4>
                        <h4 class="text-red" style="margin-top: 10px;">Notice : <br>
                            <h4>1. <span style="color: #963f3f;">Payment Button will open as soon as your paper is accepted. The status of
                                    the paper will show accepted and you have to click on "pay now" Button. After that payment page will open.</span> </h4>
                            <h4>2. <span style="color: #963f3f;">You can use your Author's Account to Submit multiple article.</span></h4>
                        </h4>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <bottom id="show_submit_form_btn" class="btn btn-primary btn-sm" >Next</bottom>
                            </div>
                        </div>
                    </div>

                </div>

                <form class="show_submit_form_div" onsubmit="return validateSubmitForm()" action="{{route('author.paper-submission.store')}}" method="post" enctype="multipart/form-data" style="border: 0px solid #e3e3e3 !important; display: none;">
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
                                    <select class="selectpicker form-control" name="type_id" >
                                        <option value="1">Research Article</option>
                                        <option value="2">Review Article</option>
                                        <option value="3">Abstract Article</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Select Journal Name <span style="color: red">*</span></label>
                                    <select class="selectpicker form-control" name="journal_id" id="cate_id_selector">
                                        <option value="">Select Journal Name</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Area of Research (Maximum 5 Attributes)<span style="color: red">*</span></label>
                                    <input id="aresearch" maxlength="120" name="aresearch" placeholder="Area of Research" class="form-control"  value="" type="text">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Paper Title<span style="color: red">*</span></label>
                                    <input id="ptitle" name="ptitle" placeholder="Manuscript/Paper Title" class="form-control"  type="text">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Abstract (Maximum 250 Words)<span style="color: red">*</span></label>
                                </div>
                                <textarea id="abstract" name="abstract" maxlength="1500" rows="10"  style="-webkit-box-sizing:border-box;-moz-box-sizing: border-box;box-sizing: border-box;width: 100%;"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6" >
                                <div id="author_name_add">
                                    <div class="form-group">
                                        <label class="control-label">Name of Author 1 (Minimum 1 Author Required)<span style="color: red">*</span></label>
                                        <input id="author_name1" name="author_name[]" placeholder="Author Name 1" class="form-control"  value="" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Name of Author 2</label>
                                        <input name="author_name[]" placeholder="Author Name 2" class="form-control" value="" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Name of Author 3</label>
                                        <input  name="author_name[]" placeholder="Author Name 3" class="form-control" value="" type="text">
                                    </div>
                                </div>
                                <a class="btn btn-default" onclick="add_new_author()">Add New Author</a>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Doc File(Only .doc and .docx file allowed) <span style="color: red">*</span></label>
                                    <div class="">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-paperclip"></i></span>
                                            <input id="docx" name="docx" onchange="docx_validation(event)" class="form-control"  type="file" style="z-index: 0;">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Only PDF File Allow (<span class="text-danger">Be confirm! You can't change it next time</span>) <span style="color: red">*</span></label>
                                    <div class="">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-paperclip"></i></span>
                                            <input id="pdf" name="pdf" onchange="pdf_validation(event)" class="form-control"  type="file" style="z-index: 0;">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Publication Issue<span style="color: red">*</span></label>
                                    <input id="issue_id" name="issue_id"  class="form-control" value="" type="hidden">
                                    <div class="form-group">
                                        <input id="select_issue_id" placeholder="Auto select Volume and Issue. You Are not valid Category Select yet" class="form-control"  value="" disabled title="Auto select Volume and Issue after Select Category">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Keywords(Minimum 1 and maximum 5 Keywords Required) <span style="color: red">*</span></label>
                                <div id="all_tags" style="margin-bottom: 5px;"></div>
                                <div class="form-group">
                                    <select id="select_Keywords"  class="form-control select2 select2-hidden-accessible" onclick="_select_this_checkbox(this)" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        <option>Add Keywords</option>
                                    </select>
                                </div>
                                <textarea id="all_ids" name="paper_tags" style="display:none;"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label"> Has your paper Article (Research) got any Funding? </label>
                                </div>
                                <label class="radio-inline">
                                    <input type="radio" id="funding_yes" name="optradio">Yes
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="funding_no" name="optradio" checked>No
                                </label>
                            </div>

                            <div class="col-md-12" id="funder_div" style="display: none;"><br>
                                <div class="form-group">
                                    <label class="control-label">Funders</label>
                                    <table class="table table-striped">
                                        <tbody>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>GRANT(US $) </th>
                                        </tr>
                                        <tr>
                                            <td>1.</td>
                                            <td>
                                                <input id="funder_name1" name="funder_name1" placeholder="Funder Name 1" class="form-control" value="" type="text">
                                            </td>
                                            <td>
                                                <input id="funder_gant_no1" name="funder_gant_no1" placeholder="funder gant no 1" class="form-control" value="" type="number">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>
                                                <input id="funder_name2" name="funder_name2" placeholder="Funder Name 2" class="form-control" value="" type="text">
                                            </td>
                                            <td>
                                                <input id="funder_gant_no2" name="funder_gant_no2" placeholder="funder gant no 2" class="form-control" value="" type="number">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3.</td>
                                            <td>
                                                <input id="funder_name3" name="funder_name3" placeholder="Funder Name 3" class="form-control" value="" type="text">
                                            </td>
                                            <td>
                                                <input id="funder_gant_no3" name="funder_gant_no3" placeholder="funder gant no 3" class="form-control" value="" type="number">
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
                                    <input id="no_figures" name="no_figures" placeholder="Number of Figures"  class="form-control" value="0" type="number">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Number of Tables (if not applicable please fill up by 0) <span style="color: red">*</span></label>
                                    <input id="no_tables" name="no_tables" placeholder="Number of Tables"  class="form-control" value="0" type="number">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Number of Words (Not more than 6000 words) <span style="color: red">*</span></label>
                                    <input id="no_words" name="no_words" placeholder="Number of Words"  class="form-control" value="0" type="number">
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
                                            <input id="terms_and_condition" name="terms_and_condition" value="1" type="checkbox" >I have read the <a href="{{route('terms_condition')}}" target="_blank">Terms & Condition</a> <span style="color: red">*</span> <span style="color: red" id="terms_and_condition_checked" class="hidden">Please Checked This checkbox</span>
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                            <input id="agreement" name="agreement" value="1" type="checkbox">I have read the <a href="{{route('privacy_policy')}}" target="_blank">Privacy Policy</a> <span style="color: red">*</span> <span id="agreement_checked" class="hidden" style="color: red">Please Checked This checkbox</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="" class="btn btn-danger pull-right" ><i class="fa fa-arrow-circle-left"></i> Back</a>
                                    <button id="submit_btn" type="submit" class="btn btn-md btn-primary"><i class="fa fa-upload"></i> Submit</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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

    $("#show_submit_form_btn").click(function(){
        $('.show_submit_form_div').slideDown();
        $('.show_submit_condition_div').hide();
        $('#show_submit_form_btn').hide();
        $("#show_submit_condition_btn").show();
    });

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
        $("#docx").change(function() { 
            if ($('#docx').prop('files').length == 1) {
                $(this).css({"border-color": "green", "border-width":"1px", "border-style":"solid"});
            }else{
                $(this).css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            }
        }); 
        $("#pdf").change(function() { 
            if ($('#pdf').prop('files').length == 1) {
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

        }else if($('#docx').val() == ""){

            $("#docx").focus();
            $("#docx").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;

        }else if($('#pdf').val() == ""){

            $("#pdf").focus();
            $("#pdf").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
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
    $('#select_Keywords').change(function() {
        var all_ids = $('#all_ids').html();
        var tag  = this.value
        if (all_ids.indexOf(tag) == -1) {
            if (checkbox_arr.length < 5) {
                checkbox_arr.push(tag);
                var apend = '<span class="tag_' + this.value + '" style="font-size: 16px;font-weight: 500;color: #4d7941; margin-left:5px;     margin-right: 10px;position: relative" class=""><span style="background-color: #3c8dbc;border-color: #367fa9;padding: 1px 10px;color: #fff;">' + this.value + '</span><sup class="" style="color: #463e3e;font-size: 20px;cursor: pointer;position: absolute;top: -5px;right: -5px;background-color: #afafaf;padding: 6px 1px; border-radius: 4px;" onclick="remove_tag(\'' + this.value + '\')">×</sup></span>'
                $("#all_tags").append(apend);
            }else {
                var error = '<span style="color: red">Maximum 5 Keywords are Allowed !!</span>'
                Swal.fire(error);
            }
        }
        var arr = JSON.stringify(checkbox_arr);
        $('#all_ids').html(arr);
    });

    function add_new_tag(){
        var  new_tag = $('.select2-search__field').val()
        var all_ids = $('#all_ids').html();
        if (all_ids.indexOf(new_tag) == -1)
            if (checkbox_arr.length < 5){
                checkbox_arr.push(new_tag);
                var apend = '<span class="tag_' + new_tag + '" style="font-size: 16px;font-weight: 500;color: #4d7941; margin-left:5px;     margin-right: 10px; position: relative" class=""><span style="background-color: #3c8dbc;border-color: #367fa9;padding: 1px 10px;color: #fff;">' + new_tag + '</span><sup class="" style="color: #463e3e;font-size: 20px;cursor: pointer;position: absolute;top: -5px;right: -5px;background-color: #afafaf;padding: 6px 1px; border-radius: 4px;" onclick="remove_tag(\'' + new_tag + '\')">×</sup></span>'
                $("#all_tags").append(apend);
                $('#add_new_tag').val('');
            }else{
                var error = '<span style="color: red">Maximum 5 Keywords are Allowed !!</span>'
                Swal.fire(error);
            }
        var arr = JSON.stringify(checkbox_arr);
        $('#all_ids').html(arr);
        $('.select2-search__field').val('')
        // $('#submit_btn').addClass('show_loader_div');
    }

    function remove_tag(me){
        var all_ids = $('#all_ids').html();
        var arr = JSON.parse( all_ids );

        var index = arr.indexOf(me);
        if (index != -1) {
            arr.splice(index, 1);
        }

        checkbox_arr = arr
        var arr = JSON.stringify( arr );
        $('#all_ids').html(arr);
        $(".tag_"+me).remove();
        console.log($('#all_ids').html())
        if( $('#all_ids').html() == '[]'){
            checkbox_arr = []
            arr = [];
            $('#all_ids').html('');
            var error = '<span style="color: red">Minimum 1 Keywords Required !!</span>'
            Swal.fire(error);
        }
        console.log(checkbox_arr);
    }


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
