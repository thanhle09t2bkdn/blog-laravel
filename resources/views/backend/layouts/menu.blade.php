@php
    $route = request()->route();
@endphp

<li class="nav-header text-uppercase">Basic</li>

<li class="nav-item">
    <a href="{{ route('backend.home.index') }}" class="nav-link {{ $route->named('home*') ? 'active' : '' }} ">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>

<li class="nav-header text-uppercase">User Info</li>

<li class="nav-item">
    <a href="{{ route('backend.users.index') }}" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>Users</p>
    </a>
</li>

<li class="nav-item">
    <a href="" class="nav-link">
        <i class="nav-icon fas fa-random"></i>
        <p>Brands</p>
    </a>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-window-restore"></i>
        <p>Kinds</p>
    </a>
</li>

<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-credit-card"></i>
        <p>
            Cards
            <i class="fas fa-angle-right right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Banks</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Cards</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-address-card"></i>
        <p>
            Memberships
            <i class="fas fa-angle-right right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Genres</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Organizations</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Memberships</p>
            </a>
        </li>
    </ul>
</li>
