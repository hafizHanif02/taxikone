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

                                <h4 class="page-title">Driver</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->



                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between" >
                                    <h4 class="header-title">Driver List</h4>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add-modal"><i class="ri-add-line"></i> New</button>
                                </div>
                                <div class="card-body">
                                    <table id=""
                                        class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th class="text-start">ID</th>
                                                <th>Driver</th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            @foreach ($drivers as $driver)
                                            <tr class="">
                                                <td class="text-start">{{$loop->count}}</td>
                                                <td id="userID{{$driver->id}}">{{$driver->name}}</td>
                                                <td class="text-end">
                                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit-modal" onclick="setDataToModel({{$driver->id}})" title="Edit"><i class="ri-edit-2-line"></i></button>
                                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal" onclick="setDataToModelDelete({{$driver->id}})" title="Delete"><i class="ri-delete-bin-line"></i></button>
                                                    <input type="hidden" id="driverdata{{$driver->id}}" data-id="{{$driver->id}}" data-name="{{$driver->name}}" data-username="{{$driver->username}}" data-email="{{$driver->email}}" data-password="{{$driver->password}}">
                                                </td>
                                            </tr>
                                            @endforeach

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
                            <h4 class="modal-title" id="add-modalLabel">Adding New Driver</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="ps-3 pe-3" action="{{route('drivers.store')}}" method="POST">
                        <div class="modal-body">
                                <div class="mb-3">
                                    @csrf
                                    <div class="row mb-2">
                                        <label for="username" class="form-label">Driver Name</label>
                                        <input class="form-control" type="text" name="name" required placeholder="Driver Name here">
                                    </div>
                                </div>


                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            {{-- Models end here --}}

            <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add-modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="add-modalLabel">Update Driver</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="ps-3 pe-3" id="editform" method="POST">
                            <div class="modal-body">
                                    <div class="mb-3">
                                        @csrf
                                        <div class="row mb-2">
                                            <label for="username" class="form-label">Driver Name</label>
                                            <input class="form-control" type="text" name="name" id="name_edit" required="" placeholder="Driver Name here">
                                        </div>
                                    </div>

                            </div>
                            <input type="hidden" name="driver_id" id="driver_id">
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>


            <!-- /.modal -->

            <div id="ride-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add-modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="add-modalLabel">Assign Ride</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="ps-3 pe-3" action="/permision" method="POST">
                        <div class="modal-body">


                                <div class="mb-3">
                                    @csrf



                                    <input class="form-control" type="text" name="hotelName" id="hotelName" required="" placeholder="hotel Name here">
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>

            <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete-modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="delete-modalLabel">Delete hotel</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="ps-3 pe-3" id="deleteform" method="POST">
                        <div class="modal-body">


                                <div class="mb-3">
                                    @csrf
                                    <label for="username" class="form-label">Are you sure, you want to delete this driver ?</label>
                                    <input type="hidden" id="driver_id_delete" name="driver_id" >
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
    $('#editform').attr('action','/driver/update/'+id  )
    var driverData = document.getElementById('driverdata' + id);
    var name = driverData.dataset.name;
    var username = driverData.dataset.username;
    var email = driverData.dataset.email;
    // var password = driverData.dataset.password;

    document.getElementById('driver_id').value = id;
    document.getElementById('name_edit').value = name;
    // document.getElementById('username_edit').value = username;
    // document.getElementById('email_edit').value = email;
    // document.getElementById('password_edit').value = password;



}

function setDataToModelDelete(id){
    $('#deleteform').attr('action','/driver/delete/'+id);
    document.getElementById('driver_id_delete').value = id;
}
</script>
