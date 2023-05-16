@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')


@push('css')

@endpush

@section('content')
    <div class="box box-danger">
        <div class="box-body">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{$category}}</h3>
                            <p> Total Categories</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tags"></i>
                        </div>
                        <a href="{{route('admin.category.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h3>{{$author}}</h3>

                            <p>Total Author</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{route('admin.show-author.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$editors}}</h3>

                            <p>Total Editors</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </div>
                        <a href="{{route('admin.editor-panel.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{$submit}}</h3>

                            <p>Total Submission</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-upload"></i>
                        </div>
                        <a href="{{route('admin.author-submission.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{$pending}}</h3>

                            <p> Pending Submission</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-upload"></i>
                        </div>
                        <a href="{{route('admin.paperpending')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{$reject}}</h3>

                            <p>Rejected Submission</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-ban"></i>
                        </div>
                        <a href="{{route('admin.paperreject')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3>{{$approved}}</h3>

                            <p>Approved Submission</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check-circle"></i>
                        </div>
                        <a href="{{route('admin.paperaccepted')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$paid}}</h3>

                            <p> Paid Submission</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check-circle"></i>
                            <i class="fa fa-money"></i>
                        </div>
                        <a href="{{route('admin.paperpaid')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green-active">
                        <div class="inner">
                            <h3>{{$publish}}</h3>

                            <p>Published Submission</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check-circle"></i>
                            <i class="fa fa-upload"></i>
                        </div>
                        <a href="{{route('admin.paperpublished')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua-active">
                        <div class="inner">
                            <h3>{{$paypal}}</h3>

                            <p>Payment from Paypal</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-cc-paypal"></i>
                        </div>
                        <a href="{{route('admin.showpayment')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{$stripe}}</h3>

                            <p>Payment from Stripe</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-cc-stripe"></i>
                        </div>
                        <a href="{{route('admin.stripepayment')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua-active">
                        <div class="inner">
                            <h3>{{$bank}}</h3>

                            <p>Bank Payment</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-bank"></i>
                        </div>
                        <a href="{{route('admin.bankpayment')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
