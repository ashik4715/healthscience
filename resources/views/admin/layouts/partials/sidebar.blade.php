<aside class="main-sidebar" style="position: fixed !important;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar fixed" style="position: absolute; top: 50px; left: 0px; right: 0px; bottom: 0px; overflow: auto; height: auto;">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('images/default.png')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <a href=""><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header"> Dashboard Section</li>
            <li class="{{Request::is('admin/dashboard')? 'active':''}}">
                <a href="{{route('admin.dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="{{Request::is('admin/email-excel*')? 'active':''}}">
                <a href="{{route('admin.email-excel.index')}}">
                    <i class="fa fa-envelope"></i> <span>Send Email</span>
                </a>
            </li>

            <li class="treeview {{Request::is('admin/submission-timer*')? 'active':'' || Request::is('admin/publish*')? 'active':''}}">
                <a href="#">
                    <i class="fa fa-clock-o"></i>
                    <span>Submission Timer</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.submission-timer.index')}}"><i class="fa fa-clock-o"></i> Deadline Timer</a></li>
                    <li><a href="{{route('admin.publish.index')}}"><i class="fa fa-clock-o"></i> Publish Date</a></li>
                </ul>
            </li>

            <li class="{{Request::is('admin/category*')? 'active':''}}">
                <a href="{{route('admin.category.index')}}">
                    <i class="fa fa-bars"></i>
                    <span> Category</span>
                </a>
            </li>

            <li class="{{Request::is('admin/about-us*')? 'active':''}}">
                <a href="{{route('admin.about-us.index')}}">
                    <i class="fa fa-group"></i>
                    <span>About Us</span>
                </a>
            </li>
            <li class="{{Request::is('admin/contact*')? 'active':''}}">
                <a href="{{route('admin.contact.index')}}">
                    <i class="fa fa-phone-square"></i>
                    <span> Contact Us</span>
                </a>
            </li>

            <li class="{{Request::is('admin/editor-panel*')? 'active':''}}">
                <a href="{{route('admin.editor-panel.index')}}">
                    <i class="fa fa-group"></i>
                    <span>Editor-panel</span>
                </a>
            </li>
            <li class="treeview {{Request::is('admin/show-payment*')? 'active':''}}">
                <a href="#">
                    <i class="fa fa-credit-card"></i>
                    <span>Show Payment</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.showpayment')}}"><i class="fa fa-cc-paypal"></i> Paypal</a></li>
                    <li><a href="{{route('admin.stripepayment')}}"><i class="fa fa-cc-stripe"></i> Stripe</a></li>
                    <li><a href="{{route('admin.bankpayment')}}"><i class="fa fa-bank"></i> Bank</a></li>
                </ul>
            </li>

            {{--============================ Author ============================--}}
            <li class="header"> Author Section</li>
            <li class="{{Request::is('admin/author-submission*')? 'active':''}}">
                <a href="{{route('admin.author-submission.index')}}">
                    <i class="fa fa-paper-plane"></i>
                    <span>Submission</span>
                </a>
            </li>
            <li class="{{Request::is('admin/paper-access*')? 'active':''}}">
                <a href="{{route('admin.paper-access.index')}}">
                    <i class="fa fa-universal-access"></i>
                    <span>Paper Access</span>
                </a>
            </li>
            <li class="{{Request::is('admin/show-author*')? 'active':''}}">
                <a href="{{route('admin.show-author.index')}}">
                    <i class="fa fa-users"></i>
                    <span>All Author</span>
                </a>
            </li>


            {{--============================ Front-End Section ============================--}}
            <li class="header"> Front-End Section</li>
            <li class="{{Request::is('admin/user-feedback*')? 'active':''}}">
                <a href="{{route('admin.user-feedback.index')}}">
                    <i class="fa fa-comments-o"></i>
                    <span>User Feedback</span>
                </a>
            </li>

            <li class="{{Request::is('admin/announcement*')? 'active':''}}">
                <a href="{{route('admin.announcement.index')}}">
                    <i class="fa fa-bullhorn"></i>
                    <span>Announcements</span>
                </a>
            </li>

            <li class="{{Request::is('admin/apc*')? 'active':''}}">
                <a href="{{route('admin.apc.index')}}">
                    <i class="fa fa-cc-paypal"></i>
                    <span>APC</span>
                </a>
            </li>
{{--            <li class="{{Request::is('admin/slider-image*')? 'active':''}}">--}}
{{--                <a href="{{route('admin.slider-image.index')}}">--}}
{{--                    <i class="fa fa-file-image-o"></i>--}}
{{--                    <span> Image Slider</span>--}}
{{--                </a>--}}
{{--            </li>--}}
            <li class="{{Request::is('admin/subscriber*')? 'active':''}}">
                <a href="{{route('admin.subscriber.index')}}">
                    <i class="fa fa-users"></i>
                    <span> Subscribers</span>
                </a>
            </li>
            <li class="{{Request::is('admin/certifications*')? 'active':''}}">
                <a href="{{route('admin.certifications.index')}}">
                    <i class="fa fa-certificate"></i>
                    <span> Certifications</span>
                </a>
            </li>
            <li class="{{Request::is('admin/testimonial*')? 'active':''}}">
                <a href="{{route('admin.testimonial.index')}}">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <span>Testimonials</span>
                </a>
            </li>

            {{-- ================================== Policy Section =============================--}}
            <li class="header">Policy Section</li>
            <li class="{{Request::is('admin/faq*')? 'active':''}}">
                <a href="{{route('admin.faq.index')}}">
                    <i class="fa fa-question-circle"></i>
                    <span> APC FAQ</span>
                </a>
            </li>
            <li class="{{Request::is('admin/terms*')? 'active':''}}">
                <a href="{{route('admin.terms.index')}}">
                    <i class="fa fa-file-text-o"></i>
                    <span> Terms and Conditions</span>
                </a>
            </li>
            <li class="{{Request::is('admin/privacy*')? 'active':''}}">
                <a href="{{route('admin.privacy.index')}}">
                    <i class="fa fa-lock"></i>
                    <span> Privacy Policy</span>
                </a>
            </li>
            <li class="{{Request::is('admin/openAccess*')? 'active':''}}">
                <a href="{{route('admin.openAccess.index')}}">
                    <i class="fa fa-unlock-alt"></i>
                    <span> Open Access Policy</span>
                </a>
            </li>
{{--            <li class="{{Request::is('admin/refundPolicy*')? 'active':''}}">--}}
{{--                <a href="{{route('admin.refundPolicy.index')}}">--}}
{{--                    <i class="fa fa-file-pdf-o"></i>--}}
{{--                    <span> Refund Policy</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="{{Request::is('admin/delivery-policy*')? 'active':''}}">--}}
{{--                <a href="{{route('admin.delivery-policy.index')}}">--}}
{{--                    <i class="fa fa-file-pdf-o"></i>--}}
{{--                    <span> Delivery Policy</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="{{Request::is('admin/delivery-web*')? 'active':''}}">--}}
{{--                <a href="{{route('admin.indexweb')}}">--}}
{{--                    <i class="fa fa-comments-o"></i>--}}
{{--                    <span>Delivery Policy Web</span>--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
