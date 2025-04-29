<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link rel="icon" type="image/x-icon" href="/assets/logo.png" />
    <title>Product Management System</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/dashboard/img/favicon.png" rel="icon">
    <link href="/dashboard/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/dashboard/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/dashboard/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/dashboard/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/dashboard/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="/dashboard/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="/dashboard/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/dashboard/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/dashboard/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fs-5" id="exampleModalLabel">Logout</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    Apakah Anda yakin ingin keluar?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    @include('dashboard.layouts.header')
    @include('dashboard.layouts.sidebar')

    <main id="main" class="main">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
        @yield('content')

    </main>
    @include('dashboard.layouts.footer')


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <script>
        setTimeout(function() {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.remove();
                }, 500);
            }
        }, 2000);
    </script>

    <!-- Vendor JS Files -->
    <script src="/dashboard/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/dashboard/vendor/chart.js/chart.umd.js"></script>
    <script src="/dashboard/vendor/echarts/echarts.min.js"></script>
    <script src="/dashboard/vendor/quill/quill.min.js"></script>
    <script src="/dashboard/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="/dashboard/vendor/tinymce/tinymce.min.js"></script>
    <script src="/dashboard/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/dashboard/js/main.js"></script>


</body>

</html>
