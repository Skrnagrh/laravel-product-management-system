<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? 'active' : 'collapsed' }}" href="/dashboard">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('categories*') ? 'active' : 'collapsed' }}" href="/categories">
                <i class="bi bi-folder"></i>
                <span>Category</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('suppliers*') ? 'active' : 'collapsed' }}" href="/suppliers">
                <i class="bi bi-truck"></i>
                <span>Supllier</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('products*') ? 'active' : 'collapsed' }}" href="/products">
                <i class="bi bi-box-seam"></i>
                <span>Product</span>
            </a>
        </li>

        @if(auth()->user()->role === 'admin')
        <li class="nav-heading">Pengaturan</li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('users*') ? 'active' : 'collapsed' }}" href="/users">
                <i class="bi bi-people-fill"></i>
                <span>Data User</span>
            </a>
        </li>
        @endif

    </ul>

</aside>
