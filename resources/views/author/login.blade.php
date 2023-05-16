@extends("website.layouts.master")

@section('title', 'Author Login | International Medical Journal')
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center mt-5 mb-5">
            <div class="col-md-6">
                <div class="card">
                    <h2 class="card-header">{{env('APP_NAME')}} <strong>Login</strong></h2>    
                    <div class="card-body bg-light-blue-50">
                        @if(session('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('message')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form action="{{route('login')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label">E-mail: <span>*</span></label>
                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control {{$errors->has('email')? 'is-invalid':''}}" name="email" required autocomplete="email" autofocus >
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label">Password: <span>*</span></label>
                                <div class="col-md-8">
                                    <input type="password" name="password" required class="form-control {{$errors->has('password')? 'is-invalid':''}}">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row d-flex justify-content-end">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <input id="logInButton" type="submit" class="submit btn btn-sm pr-3 pl-3 btn-default mr-3"  tabindex="3" value="Log In"/>
                                    <a href="{{ route('password.request') }}">Forgot your password?</a>
                                    <br>
                                    <br>
                                    <span class="text-warning pl-1">
                                        Not yet register? 
                                    </span><a href="{{ route('authorregister') }}"> Register Now</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
