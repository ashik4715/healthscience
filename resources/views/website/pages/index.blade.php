@extends('website.layouts.master')
@section('title','International Medical Journal | IMJ')

@section('content')
    <!-- <div class="slide-one-item home-slider owl-carousel">
        <div class="site-blocks-cover inner-page overlay" style="background-image: url(https://colorlib.com/preview/theme/neos/images/hero_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-6 text-center" data-aos="fade">
                        <h1 class="font-secondary  font-weight-bold text-uppercase">Welcome to Colorlib</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="site-blocks-cover inner-page overlay" style="background-image: url(https://colorlib.com/preview/theme/neos/images/hero_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7 text-center" data-aos="fade">
                        <h1 class="font-secondary font-weight-bold text-uppercase">Free Bootstrap 4 Templates</h1>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    
    <div class="site-section bg-color first-section pt-4 pb-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-4 pt-3" data-aos="fade">
                    <h3>International Medical Journal</h3>
                    <h5 class="text-justify">International Medical Journal (ISSN:13412051) originally formed in 1996 till now by Japan international cultural exchange foundation and Japan medical association. International Medical Journal is a scopus indexed medical journal that wants to make the best use of Medical and pharmaceutical Research with information from our 700+ leading-edge peer reviewed, Open Access Journals that operates with the help of 5,000+ Editorial Board Members and esteemed reviewers and 1000+ associations in Medical, Clinical, Pharmaceutical Fields</h5>
                </div>
            </div>
            <div class="row border-responsive">
                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0 border-right" data-aos="fade-up" data-aos-delay="">
                    <div class="text-center">
                        <h3 class="text-uppercase h4 mb-3">Scopus Link</h3>
                        <div style="background-color: #1c1e21; border: 1px solid #808080; box-shadow: 0px 0px 5px 2px rgb(110, 132, 152)">
                            <a href="https://www.scopus.com/sourceid/14770" title="Scopus Link" target="_blank">
                                <img border="0" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRjCs2cH6W6R1D38C90VHpNcRUuWlA4S8gRFcWjzSg-XQttXvfx&amp;s" class="img-fluid" alt="SCImago Journal &amp; Country Rank" style="height: 165px; width: 250px;">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0 border-right" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-center">
                        <span class="flaticon-bar-chart display-4 d-block mb-3 text-primary"></span>
                        <h3 class="text-uppercase h4 mb-3">Submission Deadline</h3>
                        <div class="text-center" style="padding: 5px 10px;box-shadow: 0px 0px 5px 2px rgb(110, 132, 152)">
                            <h5 style="padding: 5px 15px; font-size: 15px; font-weight: bold;">
                                <span style="">
                                   (
                                    Vol
                                    @if (!empty($submission_timer) >0) 
                                        {{ $submission_timer->volume }}
                                    @else
                                        not available
                                    @endif
                                    , Issue
                                    @if (!empty($submission_timer) >0) 
                                        {{ $submission_timer->issue }}
                                    @else
                                        not available
                                    @endif
                                    )  
                                </span> <br>
                                <span>
                                    @if (!empty($submission_timer) >0)
                                        {{ date('d M Y',strtotime($submission_timer->deadline)) }}
                                    @else
                                        00:00:00 
                                    @endif
                                </span>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0 border-right" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-center">
                        <span class="flaticon-medal display-4 d-block mb-3 text-primary"></span>
                        <h3 class="text-uppercase h4 mb-3">Submission Deadline</h3>
                        <div class="text-center" style="box-shadow: 0px 0px 5px 2px rgb(110, 132, 152)">
                            <h5 style="padding: 5px 0px; font-size: 15px; font-weight: bold;">
                                <div id="clockdiv" style="">
                                    <div>
                                        <span class="category_bg_color_set" id="days"></span>
                                        <div class="smalltext">Day</div>
                                    </div>
                                    <div>
                                        <span class="category_bg_color_set" id="hours"></span>
                                        <div class="smalltext">Hour</div>
                                    </div>
                                    <div>
                                        <span class="category_bg_color_set" id="minutes"></span>
                                        <div class="smalltext">Min</div>
                                    </div>
                                    <div>
                                        <span class="category_bg_color_set" id="seconds"></span>
                                        <div class="smalltext">Sec</div>
                                    </div>
                                </div>
                            </h5>
                        </div>
                        <style>
                            #clockdiv{
                                font-family: sans-serif;
                                color: #fff;
                                display: inline-block;
                                text-align: center;
                            }
                            #clockdiv > div{
                                padding: 5px;
                                border-radius: 3px;
                                background: #042e56;
                                display: inline-block;
                            }
                            #clockdiv div > span{
                                padding:0px 9px;
                                border-radius: 3px;
                                background: #00050a;
                                display: inline-block;
                            }
                            .smalltext{
                                padding-top: _5px;
                                font-size: _16px;
                            }
                        </style>
                        <script>
                            const second = 1000,
                            minute = second * 60,
                            hour = minute * 60,
                            day = hour * 24;

                            <?php
                            if(isset($submission_timer->deadline)){
                                $timer = $submission_timer->deadline;
                            }else{
                                $timer = '0';
                            }
                            ?>

                            var submission_timer = '{{$timer}}'
                            let countDown = new Date(submission_timer).getTime(),
                            x = setInterval(function() {

                                let now = new Date().getTime(),
                                distance = countDown - now;

                                if (Math.floor(distance / day) <= 0 && Math.floor((distance % day) / hour) <= 0 && Math.floor((distance % (hour)) / minute) <= 0 && Math.floor((distance % minute) / second) <= 0 ){
                                    document.getElementById('days').innerHTML = 0,
                                    document.getElementById('hours').innerHTML = 0,
                                    document.getElementById('minutes').innerHTML = 0,
                                    document.getElementById('seconds').innerHTML = 0;
                                }else{
                                    document.getElementById('days').innerHTML = Math.floor(distance / (day)),
                                    document.getElementById('hours').innerHTML = Math.floor((distance % (day)) / (hour)),
                                    document.getElementById('minutes').innerHTML = Math.floor((distance % (hour)) / (minute)),
                                    document.getElementById('seconds').innerHTML = Math.floor((distance % (minute)) / second);
                                }
                            }, second)
                        </script>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-center">
                        <span class="flaticon-box display-4 d-block mb-3 text-primary"></span>
                        <h3 class="text-uppercase h4 mb-3">Publish On </h3>
                        <div class="text-center" style="padding: 5px 10px;box-shadow: 0px 0px 5px 2px rgb(110, 132, 152)">
                            <h5 style="padding: 5px 15px; font-size: 15px; font-weight: bold;">
                                <span style="">
                                    
                                    (
                                    Vol
                                    @if (!empty($submission_timer) >0) 
                                        {{ $publish_date->timer->volume }}
                                    @else
                                        not available
                                    @endif
                                    , Issue
                                    @if (!empty($publish_date) >0) 
                                        {{ $publish_date->timer->issue }}
                                    @else
                                        not available
                                    @endif
                                    )
                                </span> <br>
                                <span>
                                    @if (!empty($publish_date) >0)
                                        {{ date('d M Y',strtotime($publish_date->publish_date)) }}
                                    @else
                                        00:00:00 
                                    @endif
                                </span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="site-half bg-color pt-5">
        <div class="container">
            <div class="row no-gutters align-items-stretch">
                <div class="col-md-12">
                    <h2 class="site-section-heading text-uppercase font-secondary mb-1">Aim and Scopes</h2>
                    <div class="card-body row equal-height" style="min-height: 10rem;">
                        <div class="col-md-12">
                            <h5>Aim-</h5>
                            <p class="text-justify ml-3">
                                International Medical Journal ISSN: (13412051) is an international open-access
                                journal publishes twelve times each year. The "International Medical Journal" is a peer-reviewed, monthly,
                                online international research journal, which publishes original articles, research articles, review articles with top-level work from all areas
                                of Medical Science Research and their application including Aetiology, bioengineering, biomedicine, cardiology, chiropody, ENT etc.
                                Researchers in all Medical Science and Pharmacy fields are encouraged to contribute articles based on recent research.
                                Journal publishes research articles and reviews within the whole field of Medical Science and Pharmacy Research,
                                and it will continue to provide information on the latest trends and developments in this ever-expanding subject.
                                International Medical Journal journal covers almost all disciplines of Medical Science and Pharmacy. Researchers and students
                                of M.B.B.S, M.D., D.T.C.D., GYNE., M.S.<a target="_blank" style="pointer-events: none;" rel="dofllow" href="https://www.sdippress.com/">,</a> M.Pharma, And PhD are requested to send their original research articles to International Medical Journal.
                            </p>
                            <h5>Scope-</h5>
                            <p class="text-justify ml-3">
                                International Medical Journal ISSN: (13412051) is a peer-reviewed journal. The journal seeks to
                                publish original research articles that are hypothetical and theoretical in its nature and that provide exploratory insights
                                in the following fields but not limited to: <br>

                            </p>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Anatomy</td>
                                            <td>Physiology</td>
                                            <td>Biochemistry</td>
                                            <td>Pharmacology</td>
                                        </tr>
                                        <tr>
                                            <td>Pathology</td>
                                            <td>Forensic medicine</td>
                                            <td>Microbiology</td>
                                            <td>Community Medicine</td>
                                        </tr>
                                        <tr>
                                            <td>Otorhinolaryngology</td>
                                            <td>Internal Medicine</td>
                                            <td>General Surgery</td>
                                            <td>Obstetrics and Gynecology</td>
                                        </tr>

                                        <tr>
                                            <td>Radiology</td>
                                            <td>Pulmonary Medicine</td>
                                            <td>Dermatology and Venereal diseases</td>
                                            <td>Infectious Diseases</td>
                                        </tr>
                                        <tr>
                                            <td>Anaesthesia</td>
                                            <td>Cancer research</td>
                                            <td>Neurosurgery</td>
                                            <td>Orthopedics</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="text-right" >
                                <a style="color: #8e0101; text-decoration: underline;" href="{{ route('aim_and_scope') }}#scopes">See More Scopes</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="site-half bg-color pt-5">
        <div class="container">
            <div class="row no-gutters align-items-stretch">
                <div class="col-md-12">
                    <h2 class="site-section-heading text-uppercase font-secondary">Latest Journals</h2>
                    <div class="card-body row equal-height">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 well _border-1 pt-2 pb-3">
                                    <div class="">
                                        @if(count($journals)>0)
                                            @foreach($journals as $journal)
                                            <div class="row mb-4">
                                                <div class="col-md-12 p-2" style="box-shadow: 0px 4px 6px 0px rgb(111, 132, 152);">
                                                    <strong>Title </strong>:
                                                    <a class="text-black" onclick="view_count_submit('<?php echo $journal->id;?>')" href="{{ route('single_article',$journal->title_slug) }}">
                                                        <span>{{  $journal->ptitle}}</span>
                                                    </a> <br> <br>

                                                    <span class="">Paper ID</span> : <span style="font-weight: bolder; color: red;">{{$journal->paper_id}}</span> 
                                                    <span class="">Total View</span> : <span style="font-weight: bolder; color: red;">{{$journal->view_count}}</span> 

                                                     <a class="btn btn-primary btn-sm float-right" onclick="view_count_submit('<?php echo $journal->id;?>')" href="{{ route('single_article',$journal->title_slug) }}">
                                                        <span>Full article</span>
                                                    </a>
                                                </div>
                                                <!-- <div class="col-md-4 p-2" style="box-shadow: 0px 4px 6px 0px rgb(111, 132, 152);">
                                                    <span class="">Paper ID</span> : <span style="font-weight: bolder; color: red;">IMJ-12-02-2020-238</span> <br>
                                                    <span class="">Total View</span> : <span style="font-weight: bolder; color: red;">193</span>
                                                </div> -->
                                            </div>
                                            @endforeach
                                            <div class="col-md-12 d-flex justify-content-center">
                                                <div class="text-center">
                                                    {{$journals->links()}}
                                                </div>
                                            </div>
                                            @else
                                            <div class="col-md-12">
                                                <h4 class="text-center">All Category Journal Showing here !!</h4>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="site-section pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="site-section-heading text-uppercase font-secondary">Cirtificates</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 block-13 nav-direction-white">
                    <div class="nonloop-block-13 owl-carousel">
                        @foreach(\App\Models\Certification::get() as $certification)
                        <div class="media-image">
                            <img src="{{asset('images/certifications/'.$certification->image)}}" alt="Image" class="img-fluid">
                        </div>
                         @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!--  <div class="py-5 bg-primary">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6 text-center mb-3 mb-md-0">
                    <h2 class="text-uppercase text-white mb-4" data-aos="fade-up">Try For Your Next Project</h2>
                    <a href="#" class="btn btn-bg-primary font-secondary text-uppercase" data-aos="fade-up" data-aos-delay="100">Contact Us</a>
                </div>
            </div>
        </div>
    </div> -->
    @endsection
