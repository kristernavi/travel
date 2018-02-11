<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image  info">
                {{--     <img src="img/26115.jpg" class="img-circle" alt="User Image" /> --}}
                    <i class=" fa fa-user fa-2x"></i>
                </div>
                <div class="pull-left info" style="padding-top: 10px;">
                    <p>{{ Auth::user()->name }}</p>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                @php
                $parent = 'business';
                if(Auth::user()->type == 'admin')
                    {
                        $parent = 'admin';
                    }
                @endphp
                <li class=" {{Request::segment(2) == 'home' ? 'active':''}}">
                    <a href="{{ url($parent.'/home') }}">
                        <i class="fa fa-dashboard"></i> <span>Home</span>
                    </a>
                </li>
                @if (Auth::user()->type == 'admin')

                <li class=" {{Request::segment(2) == 'users' ? 'active':''}}">
                    <a href="{{ url($parent.'/users') }}">
                        <i class="fa fa-users"></i> <span>Users</span>
                    </a>
                </li>
                 <li class=" {{Request::segment(2) == 'business-account' ? 'active':''}}">
                    <a href="{{ url($parent.'/business-account') }}">
                        <i class="fa fa-users"></i> <span>Business Accounts</span>
                    </a>
                </li>
                @endif

                <li class=" {{Request::segment(2) == 'destinations' ? 'active':''}}">
                    <a href="{{ url($parent.'/destinations') }}">
                        <i class="fa fa-map-marker"></i> <span>Services</span>
                    </a>
                </li>
                <li class=" {{Request::segment(2) == 'packages' ? 'active':''}}">
                    <a href="{{ url($parent.'/packages') }}">
                        <i class="fa fa-gift"></i> <span>Packages</span>
                    </a>
                </li>
                <li class=" {{Request::segment(2) == 'customers' ? 'active':''}}">
                    <a href="{{ url($parent.'/customers') }}">
                        <i class="fa fa-users"></i> <span>Customers</span>
                    </a>
                </li>
                <li class=" {{Request::segment(2) == 'transactions' ? 'active':''}}">
                    <a href="{{ url($parent.'/transactions') }}">
                        <i class="fa fa-money"></i> <span>Transactions</span>
                    </a>
                </li>


            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <aside class="right-side">

        <!-- Main content -->
        <section class="content">
