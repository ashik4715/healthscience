@extends('admin.layouts.app')

@section('title', 'About Us | International Medical Journal')

@push('css')
    <link rel="stylesheet" href="{{asset('admin/bower_components/datatables-bs/css/dataTables.bootstrap.min.css')}}">
    <style>
        .table-actions-bar .table-action-btn {
            color: #98a6ad;
            display: inline-block;
            width: 28px;
            border-radius: 50%;
            text-align: center;
            line-height: 24px;
            font-size: 20px;
        }
    </style>
@endpush

@section('content')

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
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <a href="{{route('admin.about-us.create')}}" class="pull-right btn btn-xs btn-primary"> <i
                                class="fa fa-plus"></i> Add New</a>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Creation Date</th>
                                <th>Membership Images</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($about as $item)
                                <tr>
                                <tr>
                                    <td><a href="#">{{$loop->index+1}}</a></td>
                                    <td>{{$item->created_at->format('d M Y')}}</td>
                                    <td>
                                        @foreach($pictures as $photo)
                                            @foreach(json_decode($photo->image, true) as $images)
                                                <img style="max-height: 45px; max-width: 45px !important;" src="{{asset($images)}}">
                                            @endforeach
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{route('admin.about-us.edit',$item->id)}}"
                                           class="btn btn-sm btn-success table-action-btn"><i
                                                    class="fa fa-pencil-square-o"></i></a>

                                        <a href="#" class="btn btn-sm btn-danger table-action-btn about_us_delete"
                                           data-content="{{$loop->index+1}}"><i
                                                    class="fa fa-trash-o"></i></a>

                                        <form id="about_us_delete{{$loop->index+1}}"
                                              action="{{route('admin.about-us.destroy',$item->id)}}"
                                              method="post" class="delete"
                                              data-content="{{$item->id}}"
                                              style="display: none;">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{asset('js/bootbox.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })
    </script>

    <script>
        $(document).on("click", ".about_us_delete", function (e) {
            var index = $(this).data('content');

            bootbox.confirm({
                message: "Do you want to remove this?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-vinndo'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-default'
                    }
                },
                callback: function (result) {
                    if (result) {
                        $("#about_us_delete" + index).submit();
                    }
                }
            });
        });
    </script>
@endpush
