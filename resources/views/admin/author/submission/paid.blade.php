@extends('admin.layouts.app')

@section('title', 'Paid Submission')

@push('css')
    <link rel="stylesheet" href="{{asset('admin/bower_components/datatables-bs/css/dataTables.bootstrap.min.css')}}">
@endpush

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="2%">#SL</th>
                                <th width="5%">Author Name</th>
                                <th width="10%">Access Key</th>
                                <th width="5%">Paper ID</th>
                                <th class="text-center" width="8%">S. Country</th>
                                <th class="text-center" width="3%">VPN</th>
                                <th width="20%">Paper Title</th>
                                <th width="5%">Date</th>
                                <th width="3%">Payment</th>
                                <th width="4%">Status</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($sl = 1)
                            @foreach($submits as $submit)
                                <tr>
                                    <td>{{$sl ++}}</td>
                                    <td>{{$submit->authorname}}</td>
                                    <td>{{$submit->paper_access_key}}</td>
                                    <td>{{$submit->paper_id}}</td>
                                    <td>{{$submit->country}}</td>
                                    <td class="text-center">
                                        @if($submit->vpn == 'yes')
                                        <span class="label label-danger">Yes</span>
                                        @else
                                        <span class="label label-success">No</span>
                                        @endif
                                    </td>
                                    <td>{{$submit->ptitle}}</td>
                                    <td>{{date('d M Y', strtotime($submit->created_at))}}</td>
                                    <td class="text-center">
                                        @if($submit->is_payment == 0 )
                                            <button class="btn btn-xs bg-red-active"><i class="fa fa-times-circle"></i> Not Paid</button>
                                            @else
                                            <button class="btn btn-xs bg-green-active"><i class="fa fa-check-circle"></i> Paid</button>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($submit->status == 0)
                                            <form action="{{route('admin.approved', $submit->id)}}" method="post" style="display: inline;" onsubmit="return confirm('Are you Sure? Want to Approved!')">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-xs btn-success" type="submit" ><i class="fa fa-check"></i></button>
                                            </form>
                                            <form action="{{route('admin.rejected', $submit->id)}}" method="post" style="display: inline;" onsubmit="return confirm('Are you Sure? Want to Rejected!')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-xs btn-danger" type="submit" ><i class="fa fa-ban"></i></button>
                                            </form>
                                        @elseif($submit->status == 1)

                                            @if($submit->publish == 0)
                                                <button class="btn btn-xs btn-warning"><i class="fa fa-spinner"></i> Accepted</button>
                                                @else
                                                <button class="btn btn-xs bg-green-active"><i class="fa fa-check-circle"></i> Published</button>
                                            @endif
                                        @else
                                            <button class="btn btn-xs bg-red-active"><i class="fa fa-ban"></i> Rejected</button>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('admin.author-submission.edit', $submit->id)}}" class="btn btn-xs btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{route('admin.author-submission.show', $submit->id)}}" class="btn btn-xs btn-info"> <i class="fa fa-eye"></i> </a>
                                        <form action="{{route('admin.author-submission.destroy', $submit->id)}}" method="post" style="display: inline;" onsubmit="return confirm('Are you Sure? Want to delete')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-xs btn-danger" type="submit" ><i class="fa fa-trash"></i></button>
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
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>
@endpush