<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                @if(Auth::user()->image)
                    <img src="{{asset('images/author_profile/'.Auth::user()->image)}}" class="img-circle" alt="Userff Image">
                @else
                    <img src="{{asset('images/default.png')}}" class="img-circle" alt="User  gggImage">
                @endif
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <a href=""><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="{{Request::is('author/dashboard')? 'active':''}}">
                <a  class="show_loader_div" href="{{route('author.dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview {{Request::is('author/profile*')? 'active':''}}">
                <a href="#">
                    <i class="fa fa-user-plus"></i>
                    <span>Profile</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a class="show_loader_div" href="{{route('author.profile.show', Auth::user()->id)}}"><i class="fa fa-fw fa-eye"></i>View Profile</a></li>
                    <li><a class="show_loader_div" href="{{route('author.profile.edit', Auth::user()->id)}}"><i class="fa fa-fw fa-edit"></i>Edit Profile</a></li>
                </ul>
            </li>
            <li class="treeview {{Request::is('author/paper-submission*')? 'active':''}}">
                <a href="#">
                    <i class="fa fa-paper-plane"></i>
                    <span>Submit</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a class="show_loader_div" href="{{route('author.paper-submission.index')}}"><i class="fa fa-fw fa-th-list"></i></i>Submission List</a></li>
                    <li><a class="show_loader_div" href="{{route('author.paper-submission.create')}}"><i class="fa fa-fw fa-plus-square-o"></i>New Submit</a></li>
                </ul>
            </li>
            <li class="">
                <a  class="show_loader_div" href="{{route('author.submission_guideline')}}">
                    <i class="fa fa-dashboard"></i> <span>Paper Submit Guidline</span>
                </a>
            </li>
            <li>
                <a href="{{ asset('CopyrightAgreementForm.pdf') }}" target="_blank">
                   <i class="fa fa-copyright"></i> <span>Copyright Agreement </span> <i class="fa fa-download"></i>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
