<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{ route('dashboard') }}" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{ asset('web/images/logo-location-finder.png' ?? 'admin/assets/img/AdminLTELogo.png') }}"
                alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            {{-- <span class="brand-text fw-light">AdminLTE</span> --}}
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ Request::path() == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('tracking.request.form') }}"
                        class="nav-link {{ Request::path() == 'tracking' ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>New Tracking Requests</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('tracking.requests') }}"
                        class="nav-link {{ Request::path() == 'tracking' ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Active Tracking Requests</p>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="./index3.html" class="nav-link ">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Track Multiple Devices</p>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a href="{{ route('tracking.history') }}"
                        class="nav-link {{ Request::path() == 'tracking-history' ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Tracking History</p>
                    </a>
                </li>

                @if (Auth::user()->role_id == '1')
                    <li class="nav-item">
                        <a href="{{ route('contacts') }}"
                            class="nav-link {{ Request::path() == 'contacts' ? 'active' : '' }}">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>All Contacts</p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('profile') }}"
                        class="nav-link {{ Request::path() == 'profile' ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Account Settings</p>
                    </a>
                </li>
                </li>

                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-pencil-square"></i>
                        <p>
                            Forms
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./forms/general.html" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>General Elements</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-table"></i>
                        <p>
                            Tables
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./tables/simple.html" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Simple Tables</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{-- <li class="nav-header">EXAMPLES</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-box-arrow-in-right"></i>
                        <p>
                            Auth
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Version 1
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="./examples/login.html" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Login</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="./examples/register.html" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Register</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Version 2
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="./examples/login-v2.html" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Login</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="./examples/register-v2.html" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Register</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="./examples/lockscreen.html" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Lockscreen</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
