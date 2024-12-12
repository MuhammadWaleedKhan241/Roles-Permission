<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- Navbar Brand -->
        <a class="navbar-brand" href="#">Navbar</a>
        <!-- Toggler Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Left Section (Links) -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link btn btn-primary text-white mx-1" href="{{ route('roles.index') }}">Roles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-info text-white mx-1"
                        href="{{ route('permissions.index') }}">Permissions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-warning text-white mx-1" href="{{ route('users.index') }}">Users</a>
                </li>
            </ul>

            <!-- Right Section (User Dropdown) -->
            <ul class="navbar-nav ms-auto">
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Log Out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>