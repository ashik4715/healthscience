@extends('admin.layouts.app')

@section('title', 'All Category')

@push('css')
    <link rel="stylesheet" href="{{asset('admin/bower_components/datatables-bs/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/bower_components/datatables-bs/css/dataTables.responsive.css')}}">
    <style>
        .tab-content {
            padding: 10px;
            border-left: 1px solid #DDD;
            border-bottom: 1px solid #DDD;
            border-right: 1px solid #DDD;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <!-- /.box-header -->
                <div class="box-body">
                    <a href="{{route('admin.category.create')}}" class="pull-right btn btn-xs btn-primary"> <i
                                class="fa fa-plus"></i> Add New</a>
                    <br>
                    <br>
                    <div class="table-responsive">
                    <table id="example1" class="table table-striped table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th>#SL</th>
                            <th>Logo</th>
                            <th>Tag</th>
                            <th>Price</th>
                            <th>Color</th>
{{--                            <th>Description</th>--}}
                            <th>Impact Factor</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td><img height="65" width="100" src="{{asset('images/category_logo/'.$category->logo)}}"
                                         alt="{{$category->name}}"></td>
                                <td>{{$category->tag}}</td>
                                <td>{{$category->price}}</td>
                                <td style="background-color: {{$category->category_color}}; color: #ffffff;"></td>
{{--                                <td>{!! $category->description !!}</td>--}}
                                <td>{{$category->impact_factor}}</td>
                                <td class="text-center">
                                    <a href="{{route('admin.category.edit', $category->id)}}"
                                       class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>

                                    <a href="#" class="btn btn-xs btn-danger table-action-btn about_us_delete"
                                       data-content="{{$loop->index+1}}"><i
                                                class="fa fa-trash-o"></i></a>

                                    <form id="about_us_delete{{$loop->index+1}}"
                                          action="{{route('admin.category.destroy', $category->id)}}"
                                          method="post" class="delete"
                                          data-content="{{$category->id}}"
                                          style="display: none;">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                    </form>
                                    {{--<form action="{{route('admin.category.destroy', $category->id)}}" method="post"--}}
                                    {{--      style="display: inline;"--}}
                                    {{--      onsubmit="return confirm('Are you Sure? Want to delete')">--}}
                                    {{--    @csrf--}}
                                    {{--    @method('DELETE')--}}
                                    {{--    <button class="btn btn-xs btn-danger" type="submit"><i class="fa fa-trash"></i>--}}
                                    {{--    </button>--}}
                                    {{--</form>--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>

@endsection

@push('scripts')
    <script src="{{asset('admin/bower_components/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables-bs/js/dataTables.responsive.js')}}"></script>
    <script src="{{asset('js/bootbox.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#example1').DataTable({
                "responsive": true,
                "bAutowidth": true,
            });
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust()
                    .responsive.recalc();
            });
        });
    </script>

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