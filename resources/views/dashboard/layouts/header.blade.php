<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="/assets/logo.png" alt="">
            <span class="d-none d-lg-block">Product Management</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    {{-- <img src="/dashboard/img/profile-img.jpg" alt="Profile" class="rounded-circle"> --}}
                    <span class="d-none d-md-block dropdown-toggle ps-2 text-capitalize">{{ Auth()->user()->name }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header text-capitalize">
                        <h6>{{ Auth()->user()->name }}</h6>
                        <span>{{ Auth()->user()->role }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item" href="/">
                            <i class="bx bx-home "></i>
                            <span class="align-middle" style='color: #21366F'>Homepage</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logout" style="cursor: pointer">
                            <i class="bi bi-box-arrow-right"></i>
                            <span class="align-middle" style='color: #21366F'>Log Out</span>
                        </a>
                    </li>

                </ul>
            </li>

        </ul>
    </nav>

</header>
