@extends('author.layouts.app')

@section('title', 'Author Dashboard')

@push('css')

@endpush

@section('content')

    <div class="row">
        <div class="col-md-9 col-xs-12">
            @if(Auth::user()->discount > 0)
                <button type="button" class="pull-right btn btn-default btn-block" style="padding: 5px; margin: -10px 0px 10px 0px;font-size: medium;"><span class="text-success text-bold">Congratulations!</span> You Got <span class="text-bold" style="font-size: 17px; color:red;"> {{Auth::user()->discount}}</span> <i class="fa fa-percent"></i> Waiver for Next Submit.
                </button>
            @endif
        </div>
        <div class="col-md-3 col-xs-12">
            <a href="{{ asset('CopyrightAgreementForm.pdf') }}" class="pull-right btn btn-primary" style="padding: 5px; margin: -10px 0px 10px 0px;">
               <i class="fa fa-copyright"></i> <span>Copyright Agreement Download</span> <i class="fa fa-download"></i>
            </a>
        </div>

    </div>

    <div class="box box-danger">
        <div class="box-body">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{$submit}}</h3>

                            <p>Total Paper Submitted</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-upload"></i>

                        </div>
                        <a href="{{route('author.paper-submission.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{$pending}}</h3>

                            <p>Pending Submission</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-spinner"></i>
                        </div>
                        <a href="{{route('author.paperpending')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{$approved}}</h3>

                            <p>Approved Submission</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check"></i>
                        </div>
                        <a href="{{route('author.paperaccepted')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                        <a href="{{route('author.paperreject')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green-active">
                        <div class="inner">
                            <h3>{{ $paid }}</h3>

                            <p>Paid Submission</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <a href="{{route('author.paperpaid')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-purple-active">
                        <div class="inner">
                            <h3>{{$published}}</h3>

                            <p>Published Submission</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-cloud-upload"></i>
                        </div>
                        <a href="{{route('author.paperpublished')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @if($paypal > 0)
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua-active">
                            <div class="inner">
                                <h3>{{$paypal}}</h3>

                                <p>Paid by Paypal</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-cc-paypal"></i>
                            </div>
                            <a href="javascript:void(0)" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                @endif

                @if($stripe > 0)
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow-active">
                            <div class="inner">
                                <h3>{{$stripe}}</h3>

                                <p>Paid by Stripe</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-cc-stripe"></i>
                            </div>
                            <a href="javascript:void(0)" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                @endif
                @if($bank > 0)
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$bank}}</h3>

                                <p>Paid by Bank</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-bank"></i>
                            </div>
                            <a href="javascript:void(0)" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- /.row -->



@endsection

@push('scripts')

@endpush
