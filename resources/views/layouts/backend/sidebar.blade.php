<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ Config::get('settings.logo') }}"
                    alt="Logo"></a>
            <a class="navbar-brand hidden" href="{{ route('home') }}"><img src="{{ Config::get('settings.logo') }}"
                    alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                @can('view_dashboard')
                    <li class="{{ is_active('home') }}">
                        <a href="{{ route('home') }}"> <i class="menu-icon fa fa-home"></i>@lang('Dashboard') </a>
                    </li>
                @endcan


                @if ((!auth()->user()->hasRole('User') &&
                    auth()->user()->can('view_Books')))
                    @can('view_books')
                        <li class="{{ is_active('books.*') }}">
                            <a href="{{ route('books.index') }}"> <i class="menu-icon fa fa-table"></i>@lang('Books')
                            </a>
                        </li>
                    @endcan

                @endif
                @if ((!auth()->user()->hasRole('User') &&
                    auth()->user()->can('view_categories')))

                    @can('view_categories')
                        <li class="{{ is_active('categories.*') }}">
                            <a href="{{ route('categories.index') }}"> <i class="menu-icon fa fa-table"></i>@lang('categories')
                            </a>
                        </li>
                    @endcan

                @endif

                @if (auth()->user()->can('view_students') ||
                    auth()->user()->can('view_users'))
                    <h3 class="menu-title">@lang('Manage Users')</h3><!-- /.menu-title -->
                    @can('view_users')
                        <li class="{{ is_active('users.*') }}">
                            <a href="{{ route('users.index') }}"> <i class="menu-icon fa fa-users"></i>@lang('Users')
                            </a>
                        </li>
                    @endcan

                    @can('view_students')
                        <li class="{{ is_active('students.*') }}">
                            <a href="{{ route('students.index') }}"> <i
                                    class="menu-icon fa fa-graduation-cap"></i>@lang('Students') </a>
                        </li>
                    @endcan

                    @can('add_role')
                        <li class="{{ is_active('roles.*') }}">
                            <a href="{{ route('roles.index') }}"> <i class="menu-icon fa fa-lock"></i>@lang('roles.roles')
                            </a>
                        </li>
                    @endcan
                @endif

                @if (auth()->user()->can('view_students') ||

                    auth()->user()->can('view_users'))
                    <h3 class="menu-title">@lang('Manage Activities')</h3><!-- /.menu-title -->


                    @can('view_news')
                        <li class="{{ is_active('newses.*') }}">
                            <a href="{{ route('newses.index') }}"> <i
                                    class="menu-icon fa fa-newspaper-o"></i>@lang('News')
                                <span class="count bg-danger">{{ count($notificationNews) }}</span></a>
                        </li>
                    @endcan
                @endif





                @if (auth()->user()->hasRole('User'))
                    <li class="{{ is_active('home') }}">
                        <a href="{{ route('home') }}"> <i class="menu-icon fa fa-home"></i>@lang('Home') </a>
                    </li>

                    <li class="{{ is_active('home') }}">
                        <a href="{{ route('home') }}"> <i class="menu-icon fa fa-envelope"></i>@lang('Messages')
                        </a>
                    </li>

                    <li class="{{ is_active('home') }}">
                        <a href="{{ route('home') }}"> <i class="menu-icon fa fa-home"></i>@lang('Home') </a>
                    </li>
                @endif

            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->
