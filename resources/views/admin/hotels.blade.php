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

                                <h4 class="page-title">Hotels</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->



                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between" >
                                    <h4 class="header-title">Hotel List</h4>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add-modal"><i class="ri-add-line"></i> New</button>
                                </div>
                                <div class="card-body">
                                    <table id="datatable-buttons"
                                        class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>User ID</th>
                                                <th>Address</th>

                                            </tr>
                                        </thead>


                                        <tbody>


                                        </tbody>
                                    </table>

                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div> <!-- end row-->


                </div> <!-- container -->

            </div> <!-- content -->


            {{-- Models start here --}}
            <!-- Standard modal content -->
            <div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add-modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="add-modalLabel">Adding New Role</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="ps-3 pe-3" action="" method="POST">
                        <div class="modal-body">


                                <div class="mb-3">
                                    @csrf
                                    <label for="username" class="form-label">Role Name</label>
                                    <input type="hidden" name="type" value="new">
                                    <input type="hidden" name="roleID" value="0">
                                    <input class="form-control" type="text" name="roleName" required="" placeholder="Role Name here">
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add-modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="add-modalLabel">Update Role</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="ps-3 pe-3" action="/permision" method="POST">
                        <div class="modal-body">


                                <div class="mb-3">
                                    @csrf
                                    <label for="username" class="form-label">Role Name</label>
                                    <input type="hidden" name="type" value="update">
                                    <input type="hidden" id="roleID" name="roleID" value="0">
                                    <input class="form-control" type="text" name="roleName" id="roleName" required="" placeholder="Role Name here">
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete-modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="delete-modalLabel">Delete Role</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="ps-3 pe-3" action="/permision" method="POST">
                        <div class="modal-body">


                                <div class="mb-3">
                                    @csrf
                                    <label for="username" class="form-label">Are you sure, you want to delete this role ?</label>
                                    <input type="hidden" name="type" value="delete">
                                    <input type="hidden" id="roleIDDelete" name="roleID" value="0">


                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Yes</button>
                        </div>
                    </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            {{-- Models end here --}}
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


<script>

function setDataToModel(id){
    console.log(id);
    let roleName = document.getElementById('name'+id).innerHTML;
    console.log(roleName);
    document.getElementById('roleName').value = roleName;
    document.getElementById('roleID').value = id;
}

function setDataToModelDelete(id){
    document.getElementById('roleIDDelete').value = id;
}
</script>
