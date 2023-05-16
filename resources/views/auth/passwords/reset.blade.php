@extends("website.layouts.master")

@section('title', 'Reset Password')
@push('css')

@endpush
@section('content')
 <div class="container">
        <div class="row d-flex justify-content-center mt-5 mb-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" _style="background-color: #04386b">
                        <span _style="color: #fff; font-weight: bold; font-size: 16px;">Request Password</span>
                    </div>
                    <div class="card-body bg-light-blue-50">
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{$error}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                        @if(session('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('message')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form action="{{ route('password.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label">E-mail: <span>*</span></label>
                                <div class="col-md-8">
                                        <input type="email" style="margin-right: 5px;" class="form-control" name="email" value="{{ old('email') }}" required>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label">Password: <span>*</span></label>
                                <div class="col-md-8">
                                        <input id="password" class="form-control form-control-sm" name="password" placeholder="Enter password" type="password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label">Confirm Password: <span>*</span></label>
                                <div class="col-md-8">
                                        <input id="password_confirmation" class="form-control form-control-sm" name="password_confirmation" placeholder="Enter confirm password" type="password" required>
                                </div>
                            </div>

                            <div class="form-group row d-flex justify-content-end">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <button id="logInButton" type="submit" class="btn btn-sm btn-warning" style="outline: none;" tabindex="3"> Reset Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
