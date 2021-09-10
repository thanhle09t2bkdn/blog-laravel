@php
    $route = request()->route();
@endphp

<li class="nav-header text-uppercase">Basic</li>

<li class="nav-item">
    <a href="{{ route('backend.sites.index') }}" class="nav-link {{ $route->named('home*') ? 'active' : '' }} ">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>

<li class="nav-header text-uppercase">User Info</li>

<li class="nav-item">
    <a href="{{ route('backend.users.index') }}" class="nav-link {{ $route->named('backend.users*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>Users</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('backend.categories.index') }}" class="nav-link {{ $route->named('backend.categories*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-random"></i>
        <p>Categories</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('backend.posts.index') }}" class="nav-link {{ $route->named('backend.posts*') ? 'active' : '' }}">
        <i class="nav-icon far fa-window-restore"></i>
        <p>Posts</p>
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

