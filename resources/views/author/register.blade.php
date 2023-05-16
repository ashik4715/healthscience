@extends("website.layouts.master")

@section('title', 'Author Registration | International Medical Journal')
@push('css')

@endpush
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center mt-4 mb-4">
            <div class="col-12 col-sm-8 ">
                <div class="card border-gold">
                    <h1 class="card-header bg-gold my-0 font-size-6">{{env('APP_NAME')}} <strong>Register</strong></h1>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <strong>Fill in this form to register with us.</strong></p>
                        <div class="well well-sm">
                            <div class="bg-light-blue-50 _well-sm">
                                <form action="{{route('register')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label" for="usr">Title: <span>*</span></label>
                                        <div class="col-md-8">
                                            <select class="form-control" required="" name="prefix">
                                                <option selected="selected">--Please select--</option>
                                                <option value="Mr">Mr.</option>
                                                <option value="Mrs">Mrs.</option>
                                                <option value="Miss">Miss</option>
                                                <option value="Professor">Professor</option>
                                                <option value="Dr">Dr.</option>
                                                <option value="Engineer">Engineer</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label" for="first_name">First Name: <span class="text-danger">*</span> </label>
                                        <div class="col-md-8">
                                            <input type="text" name="firstname" class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label" for="mname">Middle Name:</label>
                                        <div class="col-md-8">
                                            <input type="text" name="middlename" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label" for="lastname">Last Name: <span class="text-danger">*</span> </label>
                                        <div class="col-md-8">
                                            <input type="text" name="lastname" class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label" for="email">E-mail: <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <input id="email_enter" type="email" name="email" required="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label" for="email">Confirm E-mail: <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <input type="email" name="email" required="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label" for="email">Institution:</label>
                                        <div class="col-md-8">
                                            <input type="text" name="institution" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label" for="email">Department:</label>
                                        <div class="col-md-8">
                                            <input type="text" name="department" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label" for="usr">Address: <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <textarea rows="5" name="address" required="" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label" for="useremail">User-ID: <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <input type="email" id="useremail" class="form-control" required="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label" for="image">Profile Image:</label>
                                        <div class="col-md-8">
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label" for="password">Password: <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <input type="password" name="password" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label" for="password_confirmation">Re-type Password: <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <input type="password" name="password_confirmation" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"></label>
                                        <div class="col-md-8">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="form_confirm_terms_of_use" name="confirm_terms_of_use" required="" value="1">
                                                    <span class="text-danger">*</span> I have read the <a href="{{ route('terms_condition') }}">Terms of Use</a> and the <a href="{{ route('privacy_policy') }}">Privacy Policy</a> and I accept them.
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex justify-content-end">
                                        <div class="col-sm-offset-4 col-sm-8">
                                            <a href="{{url('/')}}" name="cancel" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Cancel</a>
                                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-user-plus"></i> Register</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="form-group row d-flex justify-content-end">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <span class="text-success pl-1">
                                            Already Registered?
                                        </span><a href="{{ route('authorlogin') }}"> Login Now</a>
                                    </div>
                                </div>
                                
                                <div style="border:1px dashed #333; padding:10px;">
                                    <h4 class="text-warning">Privacy Statement</h4>
                                    <p>The names and e-mail addresses entered in this site will be used exclusively for the official
                                        communication and will not be made available to any external sources.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#email_enter').keyup(function () {
            var email = $(this).val();
            $('#useremail').val(email);
        });
    </script>

@endsection
@push('scripts')
    <script>
    </script>
@endpush

