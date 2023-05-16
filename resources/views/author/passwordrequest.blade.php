@extends("website.layouts.master")

@section('title', 'Reset Password| International Medical Journal')
@section('content')
    <div id="content">
        <div class="row full-width" data-equalizer="three-column">

            <div class="top-border">
                <div id="middle-column" class="large-50 medium-6 small-12 column" data-equalizer-watch="three-column" style="height: 9448px;">
                    <div class="">
                        <div id="common-middle-column">
                            <div id="content">
                                <div class="quickform">
                                    <form action="{{route('login')}}" method="post">
                                        @csrf
                                        <fieldset style="background-color: #f6f6f6;border: 1px solid #dddddd;margin-bottom: 15px;padding-bottom: 15px;">
                                            <legend style="margin-left: 1%;background-color: #3b5998;border: 1px solid #4f5671;color: #ffffff;font-weight: bold;padding: 8px; width: 98%;">MPI Submission System Login</legend>
                                            <br>

                                            @if(session('success'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    {{session('success')}}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                            <div class="row grey">
                                                <div class="column large-12">

                                                    <div class="column large-4">
                                                        <label style="margin-top: 0;margin-bottom: 0;font-size: 13px;color:black; text-align: right;">Email :</label>
                                                    </div>
                                                    <div class="column large-6">
                                                        <input name="email" id="USERID" style="margin-right: 5px; " required>
                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>

                                                    <div class="column large-4">
                                                        <label style="margin-top: 0;margin-bottom: 0;font-size: 13px;color:black; text-align: right;">Password :</label>
                                                    </div>
                                                    <div class="column large-6">
                                                        <input type="password" name="password" id="PASSWORD" style="margin-right: 5px; " required>
                                                        @if ($errors->has('password'))
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                        @endif

                                                        <div class="">
                                                            <input id="logInButton" type="submit" class="submit"
                                                                   style="outline: none;" tabindex="3" value="Log In"/>
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('password.request') }}">Forgot your password?</a>
                                                        </div>
                                                        <br>

                                                        <div class="">
                                                            <a href="{{route('authorregister')}}">Not registered yet? Register now.</a>
                                                        </div>
                                                        <div class="">
                                                            <label style="margin-top: 0;margin-bottom: 0;font-size: 13px;color:black;"></label>
                                                        </div>
                                                        <div class="">
                                                            <label style="margin-top: 0;margin-bottom: 0;font-size: 13px;color:black;">Register With :</label>
                                                        </div>
                                                        <div class="" style="width: max-content;">
                                                            <div class="generic-item social-media-links">
                                                                <a href="{{url('auth/google')}}"   target="_blank" rel="noopener noreferrer">
                                                                    <i class="fa fa-google" style="font-size: 20px; color: #3b5998; border: 1px solid #3b5998; padding: 2px 5px;">Google</i>
                                                                </a>
                                                                <a href="{{url('auth/linkedin')}}"  target="_blank" rel="noopener noreferrer">
                                                                    <i class="fa fa-linkedin-square" style="font-size: 20px;color: #0077b5; border: 1px solid #3b5998; padding: 2px 5px;">linkedin</i>
                                                                </a>
                                                                <a href="{{url('auth/facebook')}}" target="_blank" rel="noopener noreferrer">
                                                                    <i class="fa fa-facebook-square" style="font-size: 20px; color: #4c66a4; border: 1px solid #3b5998; padding: 2px 5px;">facebook</i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div id="right-column" class="large-50 medium-6 small-12 column"
                     data-equalizer-watch="three-column" style="height: 6460px;">
                    <div class="">
                        <div><br><br>
                            <h2>Your benefits of registering with</h2>
                            <p>As a registered user you can:</p>
                            <ul>
                                <li>submit and track the progress of your manuscripts online</li>
                                <li>subscribe to receive free table of contents for your favorite journals</li>
                                <li>manage your e-mail alerts and alert frequency</li>
                                <li>save and manage your search queries</li>
                                <li>receive new publications matching your search queries</li>
                            </ul>
                            <p>Registration takes 60 seconds. <a href="{{route('authorregister')}}">Register now.</a></p>
{{--                            <div>--}}
{{--                                <a class="mdpi-products-link" href="#" target="_blank" rel="noopener noreferrer">--}}
{{--                                    <img src="https://susy.mdpi.com/bundles/mdpisusy/img/design/logo_mdpi_books.png?ff4fef74074df76b" alt="SDPI Books" title="SDPI Books" width="120">--}}
{{--                                </a>--}}
{{--                                <a class="mdpi-products-link" href="#" target="_blank" rel="noopener noreferrer">--}}
{{--                                    <img src="https://susy.mdpi.com/bundles/mdpisusy/img/design/logo_preprints.png?dc7e8cc3de3923a2" alt="Preprints" title="Preprints" width="120">--}}
{{--                                </a>--}}
{{--                                <a class="mdpi-products-link" href="#" target="_blank" rel="noopener noreferrer">--}}
{{--                                    <img src="https://susy.mdpi.com/bundles/mdpisusy/img/design/logo_sciforum.png?c8d7ac9b46fd7df7" alt="Sciforum" title="Sciforum" width="120">--}}
{{--                                </a>--}}
{{--                                <a class="mdpi-products-link" href="#" target="_blank" rel="noopener noreferrer">--}}
{{--                                    <img src="https://susy.mdpi.com/bundles/mdpisusy/img/design/logo_scilit.png?008e6a7963d7f8ee" alt="Scilit" title="Scilit" width="120">--}}
{{--                                </a>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div id="actionDisabledModal" class="reveal-modal" data-reveal="" aria-labelledby="actionDisableModalTitle" aria-hidden="true" role="dialog" style="width: 300px;">
            <h2 id="actionDisableModalTitle">Notice</h2>
            <form action="/email/captcha" method="post" id="emailCaptchaForm">
                <div class="row">
                    <div id="js-action-disabled-modal-text" class="small-12 column">
                    </div>
                    <div id="js-action-disabled-modal-submit" class="small-12 column" style="margin-top: 10px; display: none;">
                        You can make submissions to other journals
                        <a href="#" onclick="if (!window.__cfRLUnblockHandlers) return false; ga('send', 'event', 'Submit Paper', 'Send', 'Generic');">here</a>.
                    </div>
                </div>
            </form>
            <a class="close-reveal-modal" aria-label="Close">×</a>
        </div>
    </div>
@endsection
