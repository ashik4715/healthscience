@extends('website.layouts.master')
@section('title')
    User Feedback | International Medical Journal
@endsection
@section('content')

<div class="site-section bg-color first-section pt-4 pb-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4 pt-3" data-aos="fade">
                <h3>User Feedback</h3>
                <div class="well well-sm">
                            <div class="bg-light-blue-50 _well-sm">
                                <form action="{{route('store.feedback')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label" for="first_name"> Name: <span class="text-danger">*</span> </label>
                                        <div class="col-md-8">
                                            <input type="text" name="name" required="" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label" for="email">E-mail: <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <input type="email" name="email" required="" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label" for="usr">Message/Advice: <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <textarea rows="5" name="message" required="" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label" for="email">Re-commend Someone (Optional): <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <input type="email" name="recommend_email" class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"></label>
                                        <div class="col-md-8">
                                            <div class="checkbox">
                                                <label>
                                                    Did you publish any paper in IMJ Previously ? <br><br>
                                                    <input type="radio" name="pre_publish" required="" value="1"> Yes
                                                    <input type="radio" name="pre_publish" required="" value="0"> No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex justify-content-end">
                                        <div class="col-sm-offset-4 col-sm-8">
                                            <a href="http://mpi.test" name="cancel" class="btn btn-sm btn-danger">Cancel</a>
                                            <input type="submit" value="Submit" name="register" class="btn btn-sm btn-primary">
                                        </div>
                                    </div>
                                </form>
                                <div style="border:1px dashed #333; padding:10px;">
                                    <h4 class="text-warning">User Feedback Statement</h4>
                                    <p>The names and e-mail addresses entered in this site will be used exclusively for the official communication and will not be made available to any external sources.</p>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </div>
</div>
@endsection
