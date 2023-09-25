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
                                    <table id="datatable-buttons"
                                        class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr class="text-center">
                                                <th>ID</th>
                                                <th>Driver</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            @foreach ($drivers as $driver)
                                            <tr class="text-center">
                                                <td>{{$driver->id}}</td>
                                                <td id="userID{{$driver->id}}">{{$driver->name}}</td>
                                                <td class="txt-center">
                                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit-modal" onclick="setDataToModel({{$driver->id}})" title="Edit"><i class="ri-edit-2-line"></i></button>
                                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal" onclick="setDataToModelDelete({{$driver->id}})" title="Delete"><i class="ri-delete-bin-line"></i></button>
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
                                        <input class="form-control" type="text" name="name" required="" placeholder="Driver Name here">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="username" class="form-label">Driver Username</label>
                                    <input type="text" placeholder="Driver username here" class="form-control" name="username">
                                </div>
                                <div class="row mb-2">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" placeholder="Driver email here" class="form-control" name="email">
                                </div>
                                <div class="row mb-2">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" placeholder="Driver password here" class="form-control" name="password">
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
                            <h4 class="modal-title" id="add-modalLabel">Update hotel</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="ps-3 pe-3" action="/permision" method="POST">
                        <div class="modal-body">


                                <div class="mb-3">
                                    @csrf
                                    <label for="username" class="form-label">hotel Name</label>
                                    <input type="hidden" name="type" value="update">
                                    <input type="hidden" id="hotelID" name="hotelID" value="0">
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
                        <form class="ps-3 pe-3" action="/permision" method="POST">
                        <div class="modal-body">


                                <div class="mb-3">
                                    @csrf
                                    <label for="username" class="form-label">Are you sure, you want to delete this hotel ?</label>
                                    <input type="hidden" name="type" value="delete">
                                    <input type="hidden" id="hotelIDDelete" name="hotelID" value="0">


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


{{-- <script>

function setDataToModel(id){
    console.log(id);
    let hotelName = document.getElementById('name'+id).innerHTML;
    console.log(hotelName);
    document.getElementById('hotelName').value = hotelName;
    document.getElementById('hotelID').value = id;
}

function setDataToModelDelete(id){
    document.getElementById('hotelIDDelete').value = id;
}
</script> --}}
