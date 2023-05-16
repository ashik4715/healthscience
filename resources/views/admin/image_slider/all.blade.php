@extends('admin.layouts.app')

@section('title', 'Image Slider')

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
                    <a href="{{route('admin.slider-image.create')}}" class="pull-right btn btn-xs btn-primary"> <i
                                class="fa fa-plus"></i> Add New</a>
                    <br>
                    <br>
                    <div class="table-responsive">
                    <table id="example1" class="table table-striped table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th>#SL</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($images as $image)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>
                                    <img height="65" width="100" src="{{asset('images/slider_images/'.$image->image)}}"
                                         alt="{{$image->image}}">
                                </td>
                                <td>{{$image->title}}</td>
                                <td class="text-center">
                                    <a href="{{route('admin.slider-image.edit', $image->id)}}"
                                       class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
                                    <form action="{{route('admin.slider-image.destroy', $image->id)}}" method="post"
                                          style="display: inline;"
                                          onsubmit="return confirm('Are you Sure? Want to delete')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-xs btn-danger" type="submit"><i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>

@endsection

@push('scripts')
    <script src="{{asset('admin/bower_components/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables-bs/js/dataTables.responsive.js')}}"></script>
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
@endpush