@extends('controller.layout') <!-- Extend the layout file -->

@section('title', 'Controller Dashboard') <!-- Define the title -->

@section('content') <!-- Fill in the content section -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">

                                    <h4 class="page-title">Welcome!</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card widget-flat text-bg-pink">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="ri-taxi-line widget-icon"></i>
                                        </div>
                                        <h6 class="text-uppercase mt-0" title="Customers">Rides</h6>
                                        <h2 class="my-2">{{$rides }}</h2>
                                        <p class="mb-0">
                                            {{-- <span class="badge bg-white bg-opacity-10 me-1">2.97%</span>
                                            <span class="text-nowrap">Since last month</span> --}}
                                        </p>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-xxl-3 col-sm-6">
                                <div class="card widget-flat text-bg-purple">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="ri-hotel-line widget-icon"></i>
                                        </div>
                                        <h6 class="text-uppercase mt-0" title="Customers">Hotels</h6>
                                        <h2 class="my-2">{{$hotels }}</h2>
                                        <p class="mb-0">
                                            {{-- <span class="badge bg-white bg-opacity-10 me-1">18.25%</span>
                                            <span class="text-nowrap">Since last month</span> --}}
                                        </p>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-xxl-3 col-sm-6">
                                <div class="card widget-flat text-bg-info">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="ri-road-map-line widget-icon"></i>
                                        </div>
                                        <h6 class="text-uppercase mt-0" title="Customers">Destination</h6>
                                        <h2 class="my-2">{{$distinations }}</h2>
                                        <p class="mb-0">
                                            {{-- <span class="badge bg-white bg-opacity-25 me-1">-5.75%</span>
                                            <span class="text-nowrap">Since last month</span> --}}
                                        </p>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-xxl-3 col-sm-6">
                                <div class="card widget-flat text-bg-primary">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="ri-taxi-wifi-line widget-icon"></i>
                                        </div>
                                        <h6 class="text-uppercase mt-0" title="Customers">Drivers</h6>
                                        <h2 class="my-2">{{$drivers }}</h2>
                                        <p class="mb-0">
                                            {{-- <span class="badge bg-white bg-opacity-10 me-1">8.21%</span>
                                            <span class="text-nowrap">Since last month</span> --}}
                                        </p>
                                    </div>
                                </div>
                            </div> <!-- end col-->
                        </div>


                        <div class="row">


                        </div>
                        <!-- end row -->

                    </div>
                    <!-- container -->

                </div>
                <!-- content -->

                

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
@endsection
