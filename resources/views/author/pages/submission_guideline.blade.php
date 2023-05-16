@extends('author.layouts.app')

@section('title', 'Submission Guideline')

@push('css')

@endpush

@section('content')

    <div class="" style="min-height: 559px;">
    {{-- <article> --}}
       {{--  <header class="content-header container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="content-max-width">Installation</h1>
                </div>
            </div>
        </header> --}}
        <div class="content container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <section class="-content-max-width">
                        <section id="installation">
                           {{--  <p>
                                AdminLTE can be installed using multiple methods. Pick your favorite method from the list below.
                                Please be sure to check the <a href="/adminlte-docs/{v}/dependencies">dependencies section</a>
                                before continuing.
                            </p> --}}

                            <h3>1. Registration</h3>
                            <h4>Goto www.seronijihou.com > <span class="text-red">Register</span> ></h4>
                            <img src="{{ asset('images/submission_guideline/register.png') }}" class="img-responsive">

                            <h4> Open this Form Fillup It Carefully > Click <span class="text-red">‘Register With International Medical Journal’</span></h4>
                            <center><img src="{{ asset('images/submission_guideline/register_form.png') }}" class="img-responsive"></center>


                            <h3>2. Please Check Your email Click Confirmation > Then <span class="text-red">‘Login’</span></h3>
                            <h4> Input Your ‘Email’ and ‘Password’ Click ‘Log In’</h4>
                            <center> <img src="{{ asset('images/submission_guideline/author-login.png') }}" class="img-responsive"></center>
                            <h4>Now You are in Your  ‘Author Dashboard’</h4>

                            <h3>3. For New Submission Click Submit > <span class="text-red">New Submit</span></h3>
                            <img src="{{ asset('images/submission_guideline/author-dashboard-.png') }}" class="img-responsive">


                            <h3>4. Now Get Some Instructions Please read it carefully and follow it . Click <span class="text-red">‘Next’</span></h3>
                            <img src="{{ asset('images/submission_guideline/submission_instruction.png') }}" class="img-responsive">

                            <h3>5. Fillup All required field and  <span class="text-red">‘Submit’</span></h3>
                            <img src="{{ asset('images/submission_guideline/submission_form.png') }}" class="img-responsive">

                            <h3>6. Waiting for approval you will be notified within 7 working days.</h3>


                            <h3>7. After peer review if your paper is Accepted then your paper status will change. Your paper status will show “Accepted” now you are eligible to pay your payment </h3>
                            <img src="{{ asset('images/submission_guideline/paper_accepted.png') }}" class="img-responsive">


                            <h3>8. Now you pay your payment by 2 system </h3>


                            <div id="faq" role="tablist" aria-multiselectable="true">

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="questionOne">
                                        <h5 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#faq" href="#answerOne" aria-expanded="false" aria-controls="answerOne">
                                               <span class="text-red">System-1</span>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="answerOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="questionOne">
                                        <div class="panel-body">

                                            <h4>Click <span class="text-red">‘Pay Now’</span> button  </h4>
                                            <img src="{{ asset('images/submission_guideline/paper_accepted.png') }}" class="img-responsive">
                                            <br>
                                            <h4>Open New Page for payment, continue your payment procedure with any of method</h4>
                                            <img src="{{ asset('images/submission_guideline/author_pay_landing.png') }}" class="img-responsive">
                                            <h4>After paid your payment  by system-1 you get notified via mail. </h4>

                                            <h3>9.After that you download copyright agreement  by click <span class="text-red">‘Copyright Agreement’</span> or <span class="text-red">'Copyright Agreement Download’</span></h3>
                                            <img src="{{ asset('images/submission_guideline/agreement_form.png') }}" class="img-responsive">


                                            <h3>10.Click Edit Goto last section of Edit page </h3>
                                            <img src="{{ asset('images/submission_guideline/edit_for_agreement.png') }}" class="img-responsive">

                                            <h3>11.Click Edit Goto last section of Edit page </h3>
                                            <img src="{{ asset('images/submission_guideline/agreement_bank_slip_submit.png') }}" class="img-responsive">
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="questionTwo">
                                        <h5 class="panel-title">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#faq" href="#answerTwo" aria-expanded="false" aria-controls="answerTwo">
                                                <span class="text-red">System-2</span>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="answerTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="questionTwo">
                                        <div class="panel-body">
                                            <h3>9. Download copyright agreement  by click <span class="text-red">‘Copyright Agreement’</span> or  <span class="text-red">‘Copyright Agreement Download’</span> and  Fill up it. </h3>
                                            <img src="{{ asset('images/submission_guideline/agreement_form.png') }}" class="img-responsive">

                                            <h3>10. Click ‘Edit’ For bank payment </h3>
                                            <img src="{{ asset('images/submission_guideline/edit_for_agreement.png') }}" class="img-responsive">

                                            <h4>Goto last section of Edit page then you can see that Edit Agreement Paper and Payment Slip part</h4>

                                            <h3>11. Upload Scan copy</h3>

                                            <ul>
                                                <li>insert your copyright agreement ( Image or pdf file format ) on Agreement Paper Upload</li>
                                                <li>Inser bank payment slip ( Image or pdf format ) in Payment Document Scan Copy Click ‘Upload’</li>
                                            </ul>

                                            <img src="{{ asset('images/submission_guideline/agreement_bank_slip_submit.png') }}" class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <h3>Command Line</h3>

                            <h4>Via NPM</h4>
                            <p>
                            </p><pre><code>npm install admin-lte save</code></pre>
                            <p></p>

                            <h4>Via Bower</h4>
                            <p>
                            </p><pre><code>bower install admin-lte</code></pre>
                            <p></p>
                            <p>If bower asks which version of jQuery to use, choose version 3 or above.</p>

                            <h4>Via Composer</h4>
                            <p>
                            </p><pre><code>composer require "almasaeed2010/adminlte=~2.4"</code></pre>
                            <p></p>

                            <h4>Via Git</h4>
                            <ul>
                                <li>Fork the repository (<a href="https://help.github.com/articles/fork-a-repo/">guide</a>).</li>
                                <li>
                                    Clone to your machine.
                                    <pre><code>git clone https://github.com/YOUR_USERNAME/AdminLTE.git</code></pre>
                                </li>
                            </ul> --}}
                        </section>
                    </section>
                </div>
            </div>
        {{-- </article> --}}
    </div>
@endsection
@push('scripts')
@endpush
