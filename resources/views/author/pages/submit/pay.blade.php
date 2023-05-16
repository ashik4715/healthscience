@extends('author.layouts.app')

@section('title', 'Pay Now')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.css" id="theme-styles">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endpush

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <!-- /.box-header -->
                <div class="box-header text-center" style="background-color: forestgreen; color: white;">
                    @php($price = round($journal->price - $journal->price * $discount->discount / 100))
                    <h4 class="box-title">{{$journal->name}} ${{$journal->price}}
                        @if($discount->discount > 0)
                        - {{$discount->discount}}% = ${{$price}}
                        @endif
                    </h4>
                </div>
                <br>
                <div class="alert alert-info text-center" style="color: #8a6d3b !important;background-color: #fcf8e3 !important;border-color: #faebcc;}">
                    <span>If the author don't have any payment method showing below (ie. Credit card, Debit Card, American Express, Paypal,
                        Stripe, or anyother dual currency Card or don't have any sufficient way to send us the APC)  She/He can contact us
                        by Email : <span> <i class="fa fa-envelope"></i> support@seronijihou.com</span></span>
                </div>
                @if ($discount->discount > 0)
                    <div class="alert alert-info text-center" style="color: #8a6d3b !important;background-color: #fcf8e3 !important;border-color: #faebcc;}">
                        <strong><span class="text-danger">Congratulations!</span> You got {{$discount->discount}}% Waiver.</strong>
                    </div>
                @endif
                @if (Session::has('danger'))
                    <div class="alert alert-danger text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('danger') }}</p>
                    </div>
                @endif
                <div class="box-body">
                    @if($paper->is_payment == 0)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box box-primary box-solid">
                                    <div class="box box-primary" style="margin-bottom: 0px !important;">
                                    </div>
                                    <div class="credit-card-box">
                                        <div class="panel-heading" style="padding: 0px 15px !important;">
                                            <div class="row display-tr" >
                                                <div class="display-td" >
                                                    <img class="img-responsive pull-right" src="{{ asset('admin/card.png') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body" style="padding: 0px 15px 15px 15px !important;">
{{--                                            pk_test_5p6Jie25ofGZLSq3KmlTdKNt--}}
{{--                                            pk_live_w1Zv7HERZBnhfTy9vfUEVRaV00TkKKMp4j--}}
                                            <form role="form" action="{{ route('author.stripepost') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="pk_live_w1Zv7HERZBnhfTy9vfUEVRaV00TkKKMp4j" id="payment-form">
                                                @csrf
                                                <input type="hidden" name="paper_id" value="{{$paper->paper_id}}">
                                                <input type="hidden" name="price" value="{{$price}}">
                                                <div class='form-row row'>
                                                    <div class='col-xs-12 form-group required'>
                                                        <label class='control-label'>Card holder Name</label>
                                                        <input class='form-control' size='4' type='text' name="holder_name">
                                                    </div>
                                                </div>

                                                <div class='form-row row'>
                                                    <div class='col-xs-12 form-group card required'>
                                                        <label class='control-label'>Card Number</label>
                                                        <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                                                    </div>
                                                </div>

                                                <div class='form-row row'>
                                                    <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                        <label class='control-label'>CVC</label>
                                                        <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                                                    </div>
                                                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                        <label class='control-label'>Expiration Month</label>
                                                        <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                                    </div>
                                                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                        <label class='control-label'>Expiration Year</label>
                                                        <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                                    </div>
                                                </div>

                                                <div class='form-row row'>
                                                    <div class='col-md-12 error form-group hide'>
                                                        <div class='alert-danger alert'>Please correct the errors and try again.</div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <button class="btn btn-warning btn-block" type="submit">Pay Now </button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 text-center" style="margin-bottom: 15px;">
                                <button class="btn btn-info">OR</button>
                            </div>
                            <div class="col-md-5 text-center">
                                <div class="box box-primary box-solid">
                                    <div class="box box-primary">
                                    </div>
                                    <div class="box-body">
                                        <div id="paypal-button-container"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <a href="{{route('author.paper-submission.index')}}" class="btn btn-sm btn-primary pull-left"><i class="fa fa-arrow-circle-left"></i> Back</a>
                    <b style="color: green;" class="pull-right"> Your Payment is always Secured!</b>
                </div>
                @php($paperID = $paper->paper_id)
            </div>
        </div>
    </div>




@endsection

@push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.js"></script>
    <!-- test -->
    {{-- <script src="https://www.paypal.com/sdk/js?client-id=AV1FDT7c58AchuJ0t6fnpJ1Pf9dn8oj6IIcW96tzH-HbIUof252HyxrM0tAmBL2UoTF9tHBH3NP7u0Jn&currency=USD"></script> --}}

    <!-- Live -->
    <script src="https://www.paypal.com/sdk/js?client-id=Aa5Z8HIGWGuiuihbbLOXRY6qcfKu9-c9yUfxJCkpGZ7Lz1byp8d4YYG1uQb_0T13QuNhJx7az7sA4k-4&currency=USD"></script>
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                // Set up the transaction

                return actions.order.create({

                    purchase_units: [{
                        amount: {
                            value: '{{$price}}',
                            currency: 'USD'
                        }
                    }],

                });
            },
            onApprove: function(data, actions) {

                // Capture the funds from the transaction
                return actions.order.capture().then(function(details) {
                    // Show a success message to your buyer
                    var paperID = '{{$paperID}}';
                    $.ajax({
                        url: "{{route('author.paypost')}}",
                        method: "POST",
                        dataType: "JSON",
                        data: {cdetails:details, paper_id: paperID, _token: '{{csrf_token()}}'},
                        success: function (res) {
                            console.log(res);
                            Swal.fire('Transaction completed by ' + details.payer.name.given_name + '! Please check your mail');
                            window.setTimeout(function () {
                                window.location = '{{route('author.paper-submission.index')}}';
                            }, 3000);
                        }
                    });
                });
            }
        }).render('#paypal-button-container');
    </script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
        $(function() {
            var $form         = $(".require-validation");
            $('form.require-validation').bind('submit', function(e) {
                var $form         = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs       = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid         = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    // res ponse token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
    </script>

@endpush
