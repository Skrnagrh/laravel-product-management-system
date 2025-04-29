@extends('dashboard.layouts.main')

@section('content')

<section class="section dashboard">
    <div class="row">

        <div class="col-lg-12">
            <div class="row">

                <div class="col-xxl-2 col-md-3">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Category</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-folder "></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $totalCategories }}</h6>
                                    <span class="small text-muted">Category</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xxl-2 col-md-3">
                    <div class="card info-card revenue-card">


                        <div class="card-body">
                            <h5 class="card-title">Supplier</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-truck"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $totalSuppliers }}</h6>
                                    <span class="small text-muted">Supplier</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-xxl-2 col-md-3">
                    <div class="card info-card revenue-card">

                        <div class="card-body">
                            <h5 class="card-title">Product</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $totalProducts }}</h6>
                                    <span class="small text-muted">Product</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xxl-2 col-md-3">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">User</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $totalUsers }}</h6>
                                    <span class="small text-muted">User</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>


</section>

@endsection