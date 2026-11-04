<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <span class="brand-icon"><i class="fas fa-hands-helping"></i></span>
        <span class="brand-text">{{ config('app.name') }}</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                <li class="nav-item">
                    <a href="{{ route('home') }}"
                       class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('organizations.index') }}"
                       class="nav-link {{ request()->routeIs('organizations.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Organizaciones</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('volunteers.index') }}"
                       class="nav-link {{ request()->routeIs('volunteers.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-hands-helping"></i>
                        <p>Voluntarios</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
