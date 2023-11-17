@extends('layouts.app')

@section('content')
<main>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-5">
        <!-- Custom page header alternative example-->

        <!-- Illustration dashboard card example-->
        <div class="card card-waves mb-4 mt-5">
            <div class="card-body p-5">
                <div class="row align-items-center justify-content-between">
                    <div class="col">
                        <h2 class="text-primary">Selamat Datang {{ Auth::user()->name }} !</h2>
                        <p class="text-gray-700">Silahkan gunakan menu sesuai kebutuhan anda</p>
                        <a class="btn btn-primary p-3" href="#!">
                            Yuk Mulai...
                            <i class="ms-1" data-feather="arrow-right"></i>
                        </a>
                    </div>
                    <div class="col d-none d-lg-block mt-xxl-n4"><img class="img-fluid px-xl-4 mt-xxl-n5" src="https://www.pngmart.com/files/21/Gym-Equipment-PNG-HD.png" style="width: 80%; height:80%;" /></div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 1-->
                <div class="card border-start-lg border-start-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-primary mb-1">Member</div>
                                <div class="h5">$4,390</div>

                            </div>
                            <div class="ms-2"><i class="fas fa-person fa-2x text-gray-200"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 2-->
                <div class="card border-start-lg border-start-secondary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-secondary mb-1">Total Transaksi Hari ini</div>
                                <div class="h5">$27.00</div>

                            </div>
                            <div class="ms-2"><i class="fas fa-dollar-sign fa-2x text-gray-200"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 3-->
                <div class="card border-start-lg border-start-success h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-success mb-1">Personal Trainee</div>
                                <div class="h5">11,291</div>

                            </div>
                            <div class="ms-2"><i class="fas fa-person fa-2x text-gray-200"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 4-->
                <div class="card border-start-lg border-start-info h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-info mb-1">Stock Items</div>
                                <div class="h5">1.23%</div>

                            </div>
                            <div class="ms-2"><i class="fas fa-box fa-2x text-gray-200"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection
