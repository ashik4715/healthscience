<header class="main-header">
    <!-- Logo -->
    <a href="" class="logo" style="position: fixed !important;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            {{-- <img data-cfsrc="{{asset('images/IAENS_logo/M&B.png')}}" alt="IAENS" title="IAENS Open Access Journals" data-cfstyle="height: 30px;" style="height: 30px;" src="{{asset('images/IAENS_logo/M&B.png')}}"> --}}
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">Dashboard</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="{{route('admin.paper-access.index')}}">
                        <i class="fa fa-universal-access"></i>
                        <span class="label label-warning">{{ \App\Models\PaperAccess::where('is_denied',0)->where('is_accept',0)->where('status', 0)->count() }}</span>
                    </a>
                </li>
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="{{route('admin.user-feedback.index')}}">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">{{ \App\Models\UserFeedback::where('status', 0)->count() }}</span>
                    </a>
                </li>
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="{{route('admin.author-submission.index')}}" >
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">{{ \App\Models\Author\Submit::where('status', 0)->count() }}</span>
                    </a>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{asset('images/default.png')}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{Auth::user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{asset('images/default.png')}}" class="img-circle" alt="User Image">
                            <p>
                                {{Auth::user()->name}} - Admin
                                <small>Since Jan. 2019</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
