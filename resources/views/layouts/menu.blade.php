@php
    $route = request()->route();
@endphp

<li class="nav-header text-uppercase">Basic</li>

<li class="nav-item">
    <a href="{{ route('home.index') }}" class="nav-link {{ $route->named('home*') ? 'active' : '' }} ">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>

<li class="nav-header text-uppercase">User Info</li>

<li class="nav-item">
    <a href="{{ route('users.index') }}" class="nav-link {{ $route->named('users*') ? 'active' : '' }} ">
        <i class="nav-icon fas fa-user"></i>
        <p>Users</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('brands.index') }}" class="nav-link {{ $route->named('brands*') ? 'active' : '' }} ">
        <i class="nav-icon fas fa-random"></i>
        <p>Brands</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('kinds.index') }}" class="nav-link {{ $route->named('kinds*') ? 'active' : '' }} ">
        <i class="nav-icon far fa-window-restore"></i>
        <p>Kinds</p>
    </a>
</li>

<li class="nav-item has-treeview {{ $route->named('banks*') || $route->named('cards*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-credit-card"></i>
        <p>
            Cards
            <i class="fas fa-angle-right right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('banks.index') }}" class="nav-link {{ $route->named('banks*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Banks</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('cards.index') }}" class="nav-link {{ $route->named('cards*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Cards</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item has-treeview {{ $route->named('genres*') || $route->named('organizations*') || $route->named('memberships*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-address-card"></i>
        <p>
            Memberships
            <i class="fas fa-angle-right right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('genres.index') }}" class="nav-link {{ $route->named('genres*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Genres</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('organizations.index') }}" class="nav-link {{ $route->named('organizations*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Organizations</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('memberships.index') }}" class="nav-link {{ $route->named('memberships*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Memberships</p>
            </a>
        </li>
    </ul>
</li>