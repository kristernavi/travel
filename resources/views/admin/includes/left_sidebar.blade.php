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
                <li class=" {{Request::segment(2) == 'home' ? 'active':''}}">
                    <a href="{{ url('admin/home') }}">
                        <i class="fa fa-dashboard"></i> <span>Home</span>
                    </a>
                </li>
                <li class=" {{Request::segment(2) == 'users' ? 'active':''}}">
                    <a href="{{ url('admin/users') }}">
                        <i class="fa fa-users"></i> <span>Users</span>
                    </a>
                </li>
                <li class=" {{Request::segment(2) == 'destinations' ? 'active':''}}">
                    <a href="{{ url('admin/destinations') }}">
                        <i class="fa fa-map-marker"></i> <span>Destinations</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-gift"></i> <span>Packages</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-users"></i> <span>Customers</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
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