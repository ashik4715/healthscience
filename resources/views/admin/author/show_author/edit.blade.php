@extends('admin.layouts.app')

@section('title', 'All Author list')

@push('css')

@endpush

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border text-center">
                    <h3 class="box-title">Update Your Profile</h3>
                </div>

                <form class="form-horizontal" action="{{route('admin.show-author.update', $profile->id)}}" method="post" enctype="multipart/form-data">
                    {{method_field('PUT')}}
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Discount</label>
                            <div class="col-sm-6">
                                <input type="number" min="0" max="100" name="discount" class="form-control" value="{{ $profile->discount }}">
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>

                <form class="form-horizontal" action="{{route('author.profile.update', $profile->id)}}" method="post" enctype="multipart/form-data">
                    {{method_field('PUT')}}
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Title</label>
                            <div class="col-sm-9">
                                <select name="title" id="" class="form-control">
                                    <option value="Mr.">Mr.</option>
                                    <option value="Mrs.">Mrs.</option>
                                    <option value="Mst.">Mst.</option>
                                    <option value="Mis.">Mis.</option>
                                    <option value="Dr.">Dr.</option>
                                    <option value="Prof.">Prof.</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">First Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="firstname" value="{{ $profile->firstname }}" class="form-control" id="inputFirstName3" placeholder="First Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Middle Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="middlename" value="{{ $profile->middlename }}" class="form-control" id="inputMiddleName3" placeholder="Middle Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Last Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="lastname" value="{{ $profile->lastname }}" class="form-control" id="inputLastName3" placeholder="Last Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input id="useremail" value="{{ $profile->email }}" class="form-control form-control-sm" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Institution</label>
                            <div class="col-sm-9">
                                <input type="text" name="institution" value="{{ $profile->institution }}" class="form-control" id="inputInstitution3" placeholder="Institution">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Department</label>
                            <div class="col-sm-9">
                                <input type="text" name="department" value="{{ $profile->department }}" class="form-control" id="inputDepartment3" placeholder="Department">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Address</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="address" id="inputAddress3" placeholder="Address">{{ $profile->address }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">User ID</label>
                            <div class="col-sm-9">
                                <input id="useremail" value="{{ $profile->email }}" class="form-control form-control-sm" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9">
                                <input id="useremail" name="password" class="form-control form-control-sm"placeholder="Enter email address" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image" class="col-sm-3 control-label"> Profile Image</label>
                            <div class="col-sm-9">
                                @if(Auth::user()->image)
                                    <img id="imageBrowsLive" src="{{asset('images/author_profile/'.$profile->image)}}" style="width: 90px;">
                                @else
                                    <img id="imageBrowsLive" src="{{asset('images/default.png')}}"  style="width: 90px;">
                                @endif
                                <input id="image" class="form-control form-control-sm" name="image" type="file" onchange="readliveImagebrows(this);" width="90">
                            </div>

                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{route('author.profile.show', $profile->id)}}" class="btn btn-danger">Cancel</a>
                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



@push('scripts')

<script src="{{asset('admin/bower_components/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')}}"></script>

<script type="text/javascript">
    $(function () {
        CKEDITOR.replace('abstract');
        // $('.textarea').wysihtml5();
    })
</script>

@endpush
