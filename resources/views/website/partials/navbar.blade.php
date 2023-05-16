    <div class="site-wrap">
        <div class="site-mobile-menu">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class=" js-menu-toggle"><i class="fas fa-times"></i></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>


        <div  class="site-navbar-wrap js-site-navbar bg-dark">
            <div class="container bg-dark" style="position: fixed; max-width: 1200px;">
                <div class="site-navbar bg-dark text-light">
                    <div class="row align-items-center">
                        <div class="col-2">
                            <h2 class="mb-0 site-logo"><a href="index.html" class="font-weight-bold text-uppercase">
                                <img src="https://www.seronijihou.com/images/logos/imj.png" alt="" class="img-fluid" style="height: 50px;">
                            </a></h2>
                        </div>
                        <div class="col-10">
                            <nav class="site-navigation text-right" role="navigation">
                                <div class="container">
                                    <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3">
                                        <a class="site-menu-toggle js-menu-toggle"><span class="icon-menu h3 border p-1 text-light"></span></a>
                                    </div>

                                    <ul class="site-menu js-clone-nav d-none d-lg-block">
                                        <li class="active"><a href="/">Home</a></li>
                                        <li><a href="{{route('about_us')}}">About</a></li>
                                        <li class="has-children">
                                            <a href="#">Information</a>

                                            <ul class="dropdown arrow-top">
                                                <li> <a href="{{route('apc')}}">Article Processing Charges</a></li>
                                            <li>  <a href="{{route('open_access')}}">Open Access Policy</a></li>
                                            <li> <a href="{{route('terms_condition')}}">Terms and Conditions</a></li>
                                            <li> <a href="{{route('privacy_policy')}}">Privacy Policy</a></li>
                                            <li> <a href="{{route('create.feedback')}}">User Feedback</a></li>
                                            <li> <a title="For Authors" href="{{ route('authors') }}">Information For Authors</a></li>
                                            <li> <a title="Editorial Board" href="{{route('editors')}}">Information Editorial Board</a></li>
                                            <li> <a href="{{ route('contact_us') }}" title="Contact Us"> Contact Us </a><a title="Faq" href="{{ route('faq') }}">FAQ</a></li>
                                            </ul>
                                        </li>

                                        <li><a title="Editorial Board" target="_blank" href="{{route('paper_submission_guideline')}}">Guideline</a></li>
                                        @if (Route::has('login'))
                                        @auth
                                            <li><a href="{{ route('admin.dashboard') }}" title="Home" class="">
                                                <i class="fa fa-home" title="Home"></i> Dashboard
                                            </a></li>
                                            <li><a href="{{ route('logout') }}" title="Logout" class=""  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fa fa-key" title="Logout"></i> Logout
                                            </a></li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        @else

                                            @if (Route::has('register'))
                                                <li><a href="{{ route('authorregister') }}" title="Home" class=""> Register
                                                </a></li>
                                            @endif

                                            <li><a href="{{ route('authorlogin') }}" title="Home" class="">
                                             Login
                                            </a></li>
                                        @endauth
                                        <li><a class="btn btn-sm btn-outline-success" style="font-size: 12px;font-weight: bold;padding: 1px 6px;" href="https://www.seronijihou.com/author/paper-submission/create">Submit Now</a></li>
                                    @endif
                                    
                                    </ul>
                                </div>
                            </nav>

                            <!-- <nav class="site-navigation text-right " role="navigation"> -->
                                <!-- <div class="container">
                                    <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-light border p-2"><i class="fas fa-align-justify"></i></a></div>
                                    <ul class="site-menu js-clone-nav d-none d-lg-block">
                                        <li class="active"><a href="/">Home</a></li>
                                        <li><a href="{{route('about_us')}}">About</a></li>
                                        <li class="has-children">
                                            <a href="#">Information</a>

                                            <ul class="dropdown arrow-top">
                                                <li> <a href="{{route('apc')}}">Article Processing Charges</a></li>
                                            <li>  <a href="{{route('open_access')}}">Open Access Policy</a></li>
                                            <li> <a href="{{route('terms_condition')}}">Terms and Conditions</a></li>
                                            <li> <a href="{{route('privacy_policy')}}">Privacy Policy</a></li>
                                            <li> <a href="{{route('create.feedback')}}">User Feedback</a></li>
                                            <li> <a title="For Authors" href="{{ route('authors') }}">Information For Authors</a></li>
                                            <li> <a title="Editorial Board" href="{{route('editors')}}">Information Editorial Board</a></li>
                                            <li> <a href="{{ route('contact_us') }}" title="Contact Us"> Contact Us </a><a title="Faq" href="{{ route('faq') }}">FAQ</a></li>
                                            </ul>
                                        </li>
                                        <li><a title="Editorial Board" target="_blank" href="{{route('paper_submission_guideline')}}">Guideline</a></li>
                                        @if (Route::has('login'))
                                        @auth
                                            <li><a href="{{ route('admin.dashboard') }}" title="Home" class="">
                                                <i class="fa fa-home" title="Home"></i> Dashboard
                                            </a></li>
                                            <li><a href="{{ route('logout') }}" title="Logout" class=""  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fa fa-key" title="Logout"></i> Logout
                                            </a></li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        @else

                                            @if (Route::has('register'))
                                                <li><a href="{{ route('authorregister') }}" title="Home" class=""> Register
                                                </a></li>
                                            @endif

                                            <li><a href="{{ route('authorlogin') }}" title="Home" class="">
                                             Login
                                            </a></li>
                                        @endauth
                                        <li><a class="btn btn-sm btn-outline-success" style="font-size: 12px;font-weight: bold;color: #fff;padding: 1px 6px;" href="https://www.seronijihou.com/author/paper-submission/create">Submit Now</a></li>
                                    @endif
                                    </ul>
                                </div> -->
                            <!-- </nav> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>