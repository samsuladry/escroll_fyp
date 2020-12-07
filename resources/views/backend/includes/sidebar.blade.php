<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general')
            </li>
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/dashboard'))
                }}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    @lang('menus.backend.sidebar.dashboard')
                </a>
            </li>

           

            @role('university')

            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/import-csv'))
                }}" href="{{ route('admin.import-csv') }}">
                    <i class="nav-icon fas fa-upload"></i>
                    Upload CSV
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/check'))
                }}" href="{{ route('admin.check.index') }}">
                    <i class="nav-icon fas fa-upload"></i>
                    Check Imported Data
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/rector*'))
                }}" href="{{ route('admin.view-rector') }}">
                    <i class="nav-icon fas fa-list"></i>
                    List Rector
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/faculty'))
                }}" href="{{ route('admin.view-faculty') }}">
                    <i class="nav-icon fas fa-list"></i>
                    List Faculty
                </a>
            </li>
            <li class="nav-item">
                <a href="#escrollMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link"> <i class="nav-icon fas fa-certificate"></i>Escroll</a>
            </li>
            <ul class="collapse list-unstyled" id="escrollMenu">
                <li class="nav-item">
                    <a class="nav-link {{
                        active_class(Route::is('admin/template'))
                    }}" href="{{ route('admin.view-template') }}">
                        <i class="nav-icon fas fa-certificate"></i>
                        Template Management
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{
                        active_class(Route::is('admin/escroll'))
                    }}" href="{{ route('admin.escroll.index') }}">
                        <i class="nav-icon fas fa-certificate"></i>
                        Assign Template
                    </a>
                </li>
            </ul>
            

            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/digital_certificate*'))
                }}" href="{{ url('admin/digital_certificate') }}">
                    <i class="nav-icon fas fa-pencil-alt"></i>
                    Digital Certificate
                </a>
            </li>

            @endrole

           



            @if ($logged_in_user->isAdmin())


            


             <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/university'))
                }}" href="{{ route('admin.university') }}">
                    <i class="nav-icon fas fa-university"></i>
                    University
                </a>
            </li>


                <li class="nav-title">
                    @lang('menus.backend.sidebar.system')
                </li>

                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/auth*'), 'open')
                }}">
                    <a class="nav-link nav-dropdown-toggle {{
                        active_class(Route::is('admin/auth*'))
                    }}" href="#">
                        <i class="nav-icon far fa-user"></i>
                        @lang('menus.backend.access.title')

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/auth/user*'))
                            }}" href="{{ route('admin.auth.user.index') }}">
                                @lang('labels.backend.access.users.management')

                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/auth/role*'))
                            }}" href="{{ route('admin.auth.role.index') }}">
                                @lang('labels.backend.access.roles.management')
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="divider"></li>

               <!--  <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/log-viewer*'), 'open')
                }}">
                        <a class="nav-link nav-dropdown-toggle {{
                            active_class(Route::is('admin/log-viewer*'))
                        }}" href="#">
                        <i class="nav-icon fas fa-list"></i> @lang('menus.backend.log-viewer.main')
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/log-viewer'))
                        }}" href="{{ route('log-viewer::dashboard') }}">
                                @lang('menus.backend.log-viewer.dashboard')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/log-viewer/logs*'))
                        }}" href="{{ route('log-viewer::logs.list') }}">
                                @lang('menus.backend.log-viewer.logs')
                            </a>
                        </li>
                    </ul>
                </li> -->
            @endif
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
