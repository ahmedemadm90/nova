<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <img src="{{ asset('assets/images/logo.png') }}" alt="" srcset="">
        </div>
        <div class="sidebar-menu text-capitalize">
            <ul class="menu">
                <li class='sidebar-title'>{{ __('Main Menu') }}</li>
                @auth
                    <li class="sidebar-item">
                        <a class='sidebar-link text-decoration-none' href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>{{ __('Dashboard') }}</span>
                        </a>
                    </li>
                @endauth
                @can('Dashboard Per VP')
                    <li class="sidebar-item">
                        <a class='sidebar-link text-decoration-none' href="{{ route('test.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>{{ __('Dashboard 2') }}</span>
                        </a>
                    </li>
                @endcan
                @can('VPS')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-briefcase"></i>
                            <span>{{ __('VP') }}</span>
                        </a>
                        <ul class="submenu ">
                            @can('VP Create')
                                <li>
                                    <a href="{{ route('vp.create') }}" class="text-decoration-none">New VP</a>
                                </li>
                            @endcan
                            @can('VPs List')
                                <li>
                                    <a href="{{ route('vps.index') }}" class="text-decoration-none">All VPs</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Areas')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-puzzle-piece"></i>
                            <span>{{ __('Area') }}</span>
                        </a>
                        <ul class="submenu ">
                            @can('Area Create')
                                <li>
                                    <a href="{{ route('area.create') }}" class="text-decoration-none">New Area</a>
                                </li>
                            @endcan
                            @can('Areas List')
                                <li>
                                    <a href="{{ route('areas.index') }}" class="text-decoration-none">All Areas</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Classifications')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-puzzle-piece"></i>
                            <span>{{ __('Violations Classifications') }}</span>
                        </a>
                        <ul class="submenu ">
                            @can('Classification Create')
                                <li>
                                    <a href="{{ route('classification.create') }}"
                                        class="text-decoration-none">{{ __('New
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                Classification') }}</a>
                                </li>
                            @endcan
                            @can('Classifications List')
                                <li>
                                    <a href="{{ route('classifications.index') }}"
                                        class="text-decoration-none">{{ __('All
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                Classifications') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Countries')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-globe-europe"></i>
                            <span>{{ __('Countries') }}</span>
                        </a>
                        <ul class="submenu ">
                            @can('Country Create')
                                <li>
                                    <a href="{{ route('country.create') }}"
                                        class="text-decoration-none">{{ __('New Country') }}</a>
                                </li>
                            @endcan
                            @can('Countries List')
                                <li>
                                    <a href="{{ route('countries.index') }}"
                                        class="text-decoration-none">{{ __('All Countries') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('Locations')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-thumbtack"></i>
                            <span>{{ __('Locations') }}</span>
                        </a>
                        <ul class="submenu ">
                            @can('Location Create')
                                <li>
                                    <a href="{{ route('location.create') }}"
                                        class="text-decoration-none">{{ __('New Location') }}</a>
                                </li>
                            @endcan
                            @can('Locations List')
                                <li>
                                    <a href="{{ route('locations.index') }}"
                                        class="text-decoration-none">{{ __('All Locations') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Types')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-tools"></i>
                            <span>{{ __('Workers Types') }}</span>
                        </a>
                        <ul class="submenu ">
                            @can('Type Create')
                                <li>
                                    <a href="{{ route('type.create') }}"
                                        class="text-decoration-none">{{ __('New Worker Type') }}</a>
                                </li>
                            @endcan
                            @can('Types List')
                                <li>
                                    <a href="{{ route('types.index') }}"
                                        class="text-decoration-none">{{ __('All Worker Types') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Titles')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-street-view"></i>
                            <span>{{ __('Workers Titles') }}</span>
                        </a>
                        <ul class="submenu ">
                            @can('Title Create')
                                <li>
                                    <a href="{{ route('title.create') }}"
                                        class="text-decoration-none">{{ __('New Worker Titles') }}</a>
                                </li>
                            @endcan
                            @can('Titles List')
                                <li>
                                    <a href="{{ route('titles.index') }}"
                                        class="text-decoration-none">{{ __('All Titles') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Companies')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-synagogue"></i>
                            <span>{{ __('Companies') }}</span>
                        </a>
                        <ul class="submenu ">
                            @can('Worker Create')
                                <li>
                                    <a href="{{ route('company.create') }}"
                                        class="text-decoration-none">{{ __('New Company') }}</a>
                                </li>
                            @endcan
                            @can('Companies List')
                                <li>
                                    <a href="{{ route('companies.index') }}"
                                        class="text-decoration-none">{{ __('All Companies') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Service Companies')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fab fa-hire-a-helper"></i>
                            <span>{{ __('Service Companies') }}</span>
                        </a>
                        <ul class="submenu ">
                            @can('Service Company Create')
                                <li>
                                    <a href="{{ route('service.company.create') }}"
                                        class="text-decoration-none">{{ __('New Service Company') }}</a>
                                </li>
                            @endcan
                            @can('Service Companies List')
                                <li>
                                    <a href="{{ route('service.companies.index') }}"
                                        class="text-decoration-none">{{ __('All Service Companies') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Workers')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-hard-hat"></i>
                            <span>{{ __('workers') }}</span>
                        </a>
                        <ul class="submenu ">
                            @can('Worker Create')
                                <li>
                                    <a href="{{ route('worker.create') }}"
                                        class="text-decoration-none">{{ __('New Worker') }}</a>
                                </li>
                            @endcan
                            @can('Workers List')
                                <li>
                                    <a href="{{ route('workers.index') }}"
                                        class="text-decoration-none">{{ __('All Workers') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Unfixed Service Emps')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-truck"></i>
                            <span>{{ __('Unfixed Service Workers') }}</span>
                        </a>
                        <ul class="submenu ">
                            @can('Unfixed Service Emp Create')
                                <li>
                                    <a href="{{ route('unfixed.emp.create') }}"
                                        class="text-decoration-none">{{ __('New Worker') }}</a>
                                </li>
                            @endcan
                            @can('Unfixed Service Emps List')
                                <li>
                                    <a href="{{ route('unfixed.emps.index') }}"
                                        class="text-decoration-none">{{ __('All Workers') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Roles')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-user-tag"></i>
                            <span>{{ __('Roles') }}</span>
                        </a>
                        <ul class="submenu ">
                            @can('Role Create')
                                <li>
                                    <a href="{{ route('role.create') }}"
                                        class="text-decoration-none">{{ __('New Role') }}</a>
                                </li>
                            @endcan
                            @can('Roles List')
                                <li>
                                    <a href="{{ route('roles.index') }}"
                                        class="text-decoration-none">{{ __('All Roles') }}</a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                @endcan
                @can('Groups')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-headset"></i>
                            <span>{{ __('Admin Groups') }}</span>
                        </a>
                        <ul class="submenu ">
                            <li>
                                <a href="{{ route('group.create') }}"
                                    class="text-decoration-none">{{ __('New Group') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('groups.index') }}"
                                    class="text-decoration-none">{{ __('All Groups') }}</a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('Users')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-users"></i>
                            <span>{{ __('Users') }}</span>
                        </a>
                        <ul class="submenu ">
                            <li>
                                <a href="{{ route('user.create') }}"
                                    class="text-decoration-none">{{ __('New User') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('users.index') }}"
                                    class="text-decoration-none">{{ __('All Users') }}</a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('Permits')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-car"></i>
                            <span>{{ __('permits') }}</span>
                        </a>
                        <ul class="submenu ">
                            @can('Request Truck Permit')
                                <li>
                                    <a href="{{ route('permits.vehicle.create') }}"
                                        class="text-decoration-none">{{ __('truck permit') }}</a>
                                </li>
                            @endcan
                            @can('Request Private Permit')
                                <li>
                                    <a href="{{ route('permits.private.create') }}"
                                        class="text-decoration-none">{{ __('Private vehicle
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Permit') }}</a>
                                </li>
                            @endcan

                            @can('View Permits State')
                                <li>
                                    <a href="{{ route('permits.mypermits') }}"
                                        class="text-decoration-none">{{ __('My Permits State') }}</a>
                                </li>
                            @endcan

                            @can('Manage Group Private Permits')
                                <li>
                                    <a href="{{ route('permits.private.myteam') }}"
                                        class="text-decoration-none">{{ __('Manage Private
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                Permits') }}</a>
                                </li>
                            @endcan
                            @can('Manage Group Vehicles Permits')
                                <li>
                                    <a href="{{ route('permits.trucks.myteam') }}"
                                        class="text-decoration-none">{{ __('Manage Group vehicles
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            Permits') }}</a>
                                </li>
                            @endcan
                            @can('Approved Permits List')
                                <li>
                                    <a href="" class="text-decoration-none">{{ __('All Approved Permits') }}</a>
                                </li>
                            @endcan
                            @can('Refused Permits List')
                                <li>
                                    <a href="" class="text-decoration-none">{{ __('All Rejected Permits') }}</a>
                                </li>
                            @endcan
                            @can('update')
                                <li>
                                    <a href="" class="text-decoration-none">{{ __('Permits Ending Today') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Violations')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-car"></i>
                            <span>{{ __('violations') }}</span>
                        </a>
                        <ul class="submenu ">
                            @can('Violations List')
                                <li>
                                    <a href="{{ route('violations.index') }}"
                                        class="text-decoration-none">{{ __('All Violations') }}</a>
                                </li>
                            @endcan
                            @can('Violation Create')
                                <li>
                                    <a href="{{ route('violations.create') }}"
                                        class="text-decoration-none">{{ __('New Violation') }}</a>
                                </li>
                            @endcan
                            @can('Violation Date Search')
                                <li>
                                    <a href="{{ route('violations.create') }}"
                                        class="text-decoration-none">{{ __('New Violation') }}</a>
                                </li>
                            @endcan
                            @can('Violation Code Search')
                                <li>
                                    <a href="{{ route('violations.create') }}"
                                        class="text-decoration-none">{{ __('New Violation') }}</a>
                                </li>
                            @endcan
                            @can('Violation Day Search')
                                <li>
                                    <a href="{{ route('violations.create') }}"
                                        class="text-decoration-none">{{ __('New Violation') }}</a>
                                </li>
                            @endcan
                            @can('Violation VP Search')
                                <li>
                                    <a href="{{ route('violations.create') }}"
                                        class="text-decoration-none">{{ __('New Violation') }}</a>
                                </li>
                            @endcan
                            @can('Violation Area Search')
                                <li>
                                    <a href="{{ route('violations.create') }}"
                                        class="text-decoration-none">{{ __('New Violation') }}</a>
                                </li>
                            @endcan
                            @can('My Area Violation')
                                <li>
                                    <a href="{{ route('violations.myarea') }}"
                                        class="text-decoration-none">{{ __('My Area Violations') }}</a>
                                </li>
                            @endcan
                        </ul>

                    </li>
                @endcan
                @can('Uae Violations')
                    <ul class="submenu ">
                        {{-- @can('Uae Violations Create')
                    <li>
                        <a href="{{route('safety.violations.comment')}}"
                            class="text-decoration-none">{{__('Violations Needs Comment')}}</a>
                    </li>
                    @endcan --}}
                        @can('Uae Violations List')
                            <li>
                                <a href="{{ route('violations.index') }}"
                                    class="text-decoration-none">{{ __('All Violations') }}</a>
                            </li>
                        @endcan
                    </ul>
                @endcan
                @can('Safety')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-users"></i>
                            <span>{{ __('Safety') }}</span>
                        </a>
                        <ul class="submenu ">
                            @can('Safety Manage Permits 2.0')
                                <li>
                                    <a href="{{ route('safety.permits.service.index') }}"
                                        class="text-decoration-none">{{ __('Vehicle Permits') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('safety.permits.private.index') }}"
                                        class="text-decoration-none">{{ __('Private Permits') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Uae Violations')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-users"></i>
                            <span>{{ __('UAE Violations') }}</span>
                        </a>
                        <ul class="submenu ">
                            @can('Uae Violation Create')
                                <li>
                                    <a href="{{ route('uae.violations.create') }}"
                                        class="text-decoration-none">{{ __('New Violation') }}</a>
                                </li>
                            @endcan
                            @can('Uae Violations List')
                                <li>
                                    <a href="{{ route('uae.violations.index') }}"
                                        class="text-decoration-none">{{ __('All Violations') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Unfixed Permits')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="far fa-id-badge"></i>
                            <span>{{ __('Unfixed Permits') }}</span>
                        </a>
                        <ul class="submenu ">
                            <li>
                                <a href="{{ route('unfixed.permit.create') }}"
                                    class="text-decoration-none">{{ __('New Permit') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('unfixed.permits.index') }}"
                                    class="text-decoration-none">{{ __('All Permits') }}</a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('DVRS')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-server"></i>
                            <span>{{ __('Record Devices') }}</span>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('dvr.create') }}"
                                    class="text-decoration-none">{{ __('New Record Device') }}</a>
                            </li>
                            @can('DVRS List')
                                <li>
                                    <a href="{{ route('dvrs.index') }}"
                                        class="text-decoration-none">{{ __('All Record Devices') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Switches')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-ethernet"></i>
                            <span>{{ __('Switches') }}</span>
                        </a>
                        <ul class="submenu">
                            @can('Switch Create')
                                <li>
                                    <a href="{{ route('switch.create') }}"
                                        class="text-decoration-none">{{ __('New Switch') }}</a>
                                </li>
                            @endcan
                            @can('Switches List')
                                <li>
                                    <a href="{{ route('switches.index') }}"
                                        class="text-decoration-none">{{ __('All Switches') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Vlans')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-network-wired"></i>
                            <span>{{ __('Vlans') }}</span>
                        </a>
                        <ul class="submenu">
                            @can('Vlan Create')
                                <li>
                                    <a href="{{ route('vlan.create') }}"
                                        class="text-decoration-none">{{ __('New Vlan') }}</a>
                                </li>
                            @endcan
                            @can('Vlans List')
                                <li>
                                    <a href="{{ route('vlans.index') }}"
                                        class="text-decoration-none">{{ __('All Vlans') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Cameras')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-video"></i>
                            <span>{{ __('Cameras') }}</span>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('camera.create') }}"
                                    class="text-decoration-none">{{ __('New Camera') }}</a>
                            </li>
                            @can('Cameras List', Model::class)
                                <li>
                                    <a href="{{ route('cameras.index') }}"
                                        class="text-decoration-none">{{ __('All Cameras') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Haulers')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-users"></i>
                            <span>{{ __('Haulers') }}</span>
                        </a>
                        <ul class="submenu ">
                            <li>
                                <a href="{{ route('hauler.create') }}"
                                    class="text-decoration-none">{{ __('New Hauler') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('haulers.index') }}"
                                    class="text-decoration-none">{{ __('All Haulers') }}</a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('CLM')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-users"></i>
                            <span>{{ __('CLM') }}</span>
                        </a>
                        <ul class="submenu ">
                            @can('Request Truck Permit')
                                <li>
                                    <a href="{{ route('permits.vehicle.create') }}"
                                        class="text-decoration-none">{{ __('Service Vehicle Permit') }}</a>
                                </li>
                            @endcan
                            @can('Request Private Permit')

                                <li>
                                    <a href="{{ route('unfixed.permit.create') }}"
                                        class="text-decoration-none">{{ __('Request Unfixed Permit') }}</a>
                                </li>
                            @endcan
                            <li>
                                <a href="{{ route('permits.private.create') }}"
                                    class="text-decoration-none">{{ __('Private Vehicle Permit') }}</a>
                            </li>
                            @can('Manage Group Permits')
                                <li>
                                    <a href="{{ route('group.permits') }}"
                                        class="text-decoration-none">{{ __('My Group Permits') }}</a>
                                </li>
                            @endcan
                            @can('Safety Manage Permits')
                                <li>
                                    <a href="{{ route('unfixed.safety.permit.index') }}"
                                        class="text-decoration-none">{{ __('Permits Waitting Safety Approve') }}</a>
                                </li>
                            @endcan
                            @can('Security Manage Permits')
                                <li>
                                    <a href="{{ route('unfixed.security.permit.index') }}"
                                        class="text-decoration-none">{{ __('Permits Waitting Security Approve') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
