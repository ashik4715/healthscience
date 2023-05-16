@extends('admin.layouts.app')

@section('title', 'All Certifications')

@push('css')

@endpush

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <!-- /.box-header -->
                <div class="box-body">
                    <a href="{{route('admin.certifications.create')}}" class="pull-right btn btn-xs btn-primary"> <i
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
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($images as $image)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>
                                    <img height="65" width="100" src="{{asset('images/certifications/'.$image->image)}}"
                                         alt="{{$image->image}}">
                                </td>
                                <td>{{$image->title}}</td>
                                <td>{{date('d M Y', strtotime($image->created_at))}}</td>
                                <td>
                                    @if($image->status == 0)
                                        <span class="badge bg-yellow">Inactive</span>
                                        @else
                                        <span class="badge bg-green">Active</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{route('admin.certifications.edit', $image->id)}}"
                                       class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                    <form action="{{route('admin.certifications.destroy', $image->id)}}" method="post"
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
                'autoWidth': false,
                'descending': true
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust()
                    .responsive.recalc();
            });
        });
    </script>
@endpush