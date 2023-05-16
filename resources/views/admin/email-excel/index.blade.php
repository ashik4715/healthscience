@extends('admin.layouts.app')

@section('title', 'Uploaded Email')

@push('css')
    <link rel="stylesheet" href="{{asset('admin/bower_components/datatables-bs/css/dataTables.bootstrap.min.css')}}">
@endpush

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{$error}}
            </div>
        @endforeach
    @endif
    <div class="row">
        @if(session()->has('message'))
            <div class="col-lg-12 col-xl-12">
                <div class="card-box">
                    <div class="alert alert-danger">
                        {{session('message')}}
                    </div>
                </div>
            </div>
        @endif
        @if(session()->has('failure'))
            <div class="col-lg-12 col-xl-12">
                <div class="card-box">
                    <div class="alert alert-danger">
                        {{session('failure')}}
                    </div>
                </div>
            </div>
        @endif
        @if(session()->has('success'))
            <div class="col-lg-12 col-xl-12">
                <div class="card-box">
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                </div>
            </div>
        @endif
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <a href="{{route('admin.sentmail')}}" class="btn btn-xs btn-danger"> <i
                                class="fa fa-send"></i> Sent Email</a>
                    @if($row > 0)
                        <button type="button" id="select-mail" class="pull-right btn btn-xs btn-info" data-toggle="modal" >
                            <i class="fa fa-upload"></i> Send Mail</button>
                        </button>
                    @endif
                    <a href="{{route('admin.email-excel.create')}}" class="pull-right btn btn-xs btn-primary" style="margin-right: 5px !important;"> <i
                                class="fa fa-upload"></i> Upload Excel File</a>
                    <br>
                    <br>
                    <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Publisher</th>
                            <th>Country</th>
                            <th>Email</th>
                            <th>Year</th>
{{--                            <th>Action</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($email_excel as $email)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$email->author_name}}</td>
                                    <td>{{$email->publisher}}</td>
                                    <td>{{$email->country}}</td>
                                    <td>{{$email->email}}</td>
                                    <td>{{$email->year}}</td>
{{--                                    <td>--}}
{{--                                        <a href="{{route('admin.email-excel.edit',$email->id)}}"--}}
{{--                                        class="btn btn-xs btn-success table-action-btn"><i--}}
{{--                                                    class="fa fa-pencil-square-o"></i></a>--}}

{{--                                        <a href="#" class="btn btn-xs btn-danger table-action-btn on_delete"--}}
{{--                                        data-content="{{$loop->index+1}}"><i--}}
{{--                                                    class="fa fa-trash-o"></i></a>--}}

{{--                                        <form id="on_delete{{$loop->index+1}}"--}}
{{--                                            action="{{route('admin.email-excel.destroy',$email->id)}}"--}}
{{--                                            method="post" class="delete"--}}
{{--                                            data-content="{{$email->id}}"--}}
{{--                                            style="display: none;">--}}
{{--                                            {{csrf_field()}}--}}
{{--                                            {{method_field('DELETE')}}--}}
{{--                                        </form>--}}

{{--                                    </td>--}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    ================================== Modal =====================================================--}}

    <div class="modal fade" id="modal-mail">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 5px;">
                <div class="modal-body">
                        <div class="box-header">
                            <i class="fa fa-envelope" style="color: orangered;"></i>

                            <h3 class="box-title">Compose Email</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>

                        </div>
                        <div class="box-body">
                            <form action="{{route('admin.send')}}" id="email-multiselect" method="post">
                                @csrf
                                <div class="form-group">
                                    <select name="category_id" id="" class="form-control">
                                        <option selected="false"> Select A Journal</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject">
                                </div>

                                <div>
                                  <textarea class="textarea" placeholder="Message" name="message"
                                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                  </textarea>
                                </div>
                                <br>
                                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                <button type="submit" class="btn btn-success pull-right" id="sendEmail">Send
                                    <i class="fa fa-arrow-circle-right"></i>
                                </button>
                            </form>
                        </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


@endsection

@push('scripts')
    <script src="{{asset('js/bootbox.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables-bs/js/dataTables.checkboxes.min.js')}}"></script>
    <script>
        $(function () {
            var table = $('#example1').DataTable({
                'columnDefs':[
                    {
                        'targets' :0,
                        'checkboxes': {
                            'selectRaw':true
                        }
                    }
                ],
                'select':{
                    'style' : 'multi'
                }
            });
            $('#select-mail').on('click', function (e) {
                var form = this;
                var selected_raws = table.column(0).checkboxes.selected();

                if (selected_raws.length > 0){
                    $("#select-mail").attr('data-target', '#modal-mail');
                }else {
                    Swal.fire('<span class="text-danger">Please select at least 1 row</span>');
                    $("#select-mail"). removeAttr("data-target", "#modal-mail");
                }

                $.each(selected_raws, function(index, rowId){
                    $('form').append(
                        $('<input>')
                            .attr('type', 'hidden')
                            .attr('name', 'emailID[]')
                            .val(rowId)
                    );
                });
            })
        })
    </script>

{{--    ================================== On Delete Return confirm js==================================--}}
{{--    <script>--}}
{{--        $(document).on("click", ".on_delete", function (e) {--}}
{{--            var index = $(this).data('content');--}}

{{--            bootbox.confirm({--}}
{{--                message: "Do you want to remove this?",--}}
{{--                buttons: {--}}
{{--                    confirm: {--}}
{{--                        label: 'Yes',--}}
{{--                        className: 'btn btn-xs btn-danger'--}}
{{--                    },--}}
{{--                    cancel: {--}}
{{--                        label: 'No',--}}
{{--                        className: 'btn btn-xs btn-success'--}}
{{--                    }--}}
{{--                },--}}
{{--                callback: function (result) {--}}
{{--                    if (result) {--}}
{{--                        $("#on_delete" + index).submit();--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endpush
