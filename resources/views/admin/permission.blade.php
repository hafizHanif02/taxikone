@extends('admin.layout') <!-- Extend the layout file -->

@section('title', 'Admin Dashboard') <!-- Define the title -->

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

                                <h4 class="page-title">Permissions</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->



                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between" >
                                    <h4 class="header-title">Roles List</h4>
                                    <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="ri-add-line"></i> New</button>
                                </div>
                                <div class="card-body">
                                    <table id="datatable-buttons"
                                        class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Role</th>
                                                <th>Modules</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>


                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>System Architect</td>
                                                <td>24</td>
                                                <td>
                                                    <button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="ri-edit-2-line"></i></button>
                                                    <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View"><i class="ri-eye-line"></i></button>
                                                    <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ri-delete-bin-line"></i></button>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Accountant</td>
                                                <td>55</td>
                                                <td>63</td>

                                            </tr>


                                        </tbody>
                                    </table>

                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div> <!-- end row-->


                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center">
                            <script>document.write(new Date().getFullYear())</script> © Velonic - Theme by <b>Techzaa</b>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
@endsection
