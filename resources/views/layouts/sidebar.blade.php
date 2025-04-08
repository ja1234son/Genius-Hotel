<div class="deznav">
    <div class="deznav-scroll">

        <ul class="metismenu" id="menu">
            <!-- Dashboard Module -->
            @if(auth()->user()->email && strpos(auth()->user()->email, '@admin.com') !== false)
                <li><a class="" href="{{url('admin-dashboard')}}" aria-expanded="false">
                        <i class="fa fa-dashboard"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
            @else
                @can('View Dashboard Module')
                    <li><a class="" href="{{url('admin-dashboard')}}" aria-expanded="false">
                            <i class="fa fa-dashboard"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                @endcan
            @endif

            <!-- Rooms Module -->
            @if(auth()->user()->email && strpos(auth()->user()->email, '@admin.com') !== false)
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-home"></i>
                        <span class="nav-text">Rooms</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{url('roomtypes')}}">Room Types</a></li>
                        <li><a href="{{url('rooms')}}">Rooms</a></li>
                    </ul>
                </li>
            @else
                @can('View Rooms Module')
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="fa fa-home"></i>
                        <span class="nav-text">Rooms</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{url('roomtypes')}}">Room Types</a></li>
                        <li><a href="{{url('rooms')}}">Rooms</a></li>
                    </ul>
                    </li>
                @endcan
            @endif

            <!-- Department Module -->
            @if(auth()->user()->email && strpos(auth()->user()->email, '@admin.com') !== false)
                <li><a href="{{url('departments')}}" class="ai-icon" aria-expanded="false">
                    <i class="fa fa-book"></i>
                    <span class="nav-text">Department</span>
                </a>
                </li>
            @else
                @can('View Department Module')
                    <li><a href="{{url('departments')}}" class="ai-icon" aria-expanded="false">
                        <i class="fa fa-book"></i>
                        <span class="nav-text">Department</span>
                    </a>
                    </li>
                @endcan
            @endif

            <!-- Staff Module -->
            @if(auth()->user()->email && strpos(auth()->user()->email, '@admin.com') !== false)
                <li><a href="{{url('staffs')}}" class="ai-icon" aria-expanded="false">
                    <i class="fa fa-users"></i>
                    <span class="nav-text">Staffs</span>
                </a>
                </li>
            @else
                @can('View Staff Module')
                    <li><a href="{{url('staffs')}}" class="ai-icon" aria-expanded="false">
                        <i class="fa fa-users"></i>
                        <span class="nav-text">Staffs</span>
                    </a>
                    </li>
                @endcan
            @endif

            <!-- Bookings Module -->
            @if(auth()->user()->email && strpos(auth()->user()->email, '@admin.com') !== false)
                <li><a href="{{route('booking.list')}}" class="ai-icon" aria-expanded="false">
                    <i class="fa fa-calendar"></i>
                    <span class="nav-text">Bookings</span>
                </a>
                </li>
            @else
                @can('View Bookings Module')
                    <li><a href="{{route('booking.list')}}" class="ai-icon" aria-expanded="false">
                        <i class="fa fa-calendar"></i>
                        <span class="nav-text">Bookings</span>
                    </a>
                    </li>
                @endcan
            @endif

            <!-- Settings Module -->
            @if(auth()->user()->email && strpos(auth()->user()->email, '@admin.com') !== false)
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-cogs"></i>
                    <span class="nav-text">Settings</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('roles')}}">Roles</a></li>
                    <li><a href="{{route('users')}}">Users</a></li>
                </ul>
                </li>
            @else
                @can('View Settings Module')
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="fa fa-cogs"></i>
                        <span class="nav-text">Settings</span>
                    </a>
                    <ul aria-expanded="false">
                        @can('View Roles')
                            <li><a href="{{route('roles')}}">Roles</a></li>
                        @endcan
                        @can('View Users')
                            <li><a href="{{route('users')}}">Users</a></li>
                        @endcan
                    </ul>
                    </li>
                @endcan
            @endif
        </ul>

        <!-- Profile Dropdown -->
        <div class="dropdown header-profile">
            <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                <img src="{{url('assets/images/avatar/1.png')}}" width="10" alt=""/>
                <div class="header-info">
                    <span class="font-w400 mb-0">Hello,<b>{{auth()->user()->first_name}}</b></span>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a href="{{ route('logout') }}" class="dropdown-item ai-icon">
                    <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    <span class="ms-2">Logout </span>
                </a>
            </div>
        </div>
    </div>
</div>
