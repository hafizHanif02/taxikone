@extends('controller.layout') <!-- Extend the layout file -->

@section('title', 'List Destination') <!-- Define the title -->

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

                                <h4 class="page-title">Destination</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->



                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between" >
                                    <h4 class="header-title">Destination List</h4>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add-modal"><i class="ri-add-line"></i> New</button>
                                </div>
                                <div class="card-body">
                                    <table id="datatable-buttons"
                                        class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Destination</th>
                                                <th>Address</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>


                                        <tbody>


                                            @foreach ($dest as $dst)
                                            <tr>
                                                <td>{{$dst->id}}</td>
                                                <td id="name{{$dst->id}}">{{$dst->name}}</td>
                                                <td id="address{{$dst->id}}">{{$dst->address}}</td>
                                                <td class="txt-center">
                                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit-modal" onclick="setDataToModel({{$dst->id}})" title="Edit"><i class="ri-edit-2-line"></i></button>
                                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal" onclick="setDataToModelDelete({{$dst->id}})" title="Delete"><i class="ri-delete-bin-line"></i></button>
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
                            <h4 class="modal-title" id="add-modalLabel">Adding New Role</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="ps-3 pe-3" action="" method="POST">
                        <div class="modal-body">


                                <div class="mb-3">
                                    @csrf

                                    <input type="hidden" name="type" value="new">
                                    <input type="hidden" name="destID" value="0">
                                    <label for="username" class="form-label">Destination Name</label>
                                    <input class="form-control" type="text" name="destinationName" required="" placeholder="Name here">
                                    <br>
                                    <label for="username" class="form-label">Destination Address</label>
                                    <input class="form-control" type="text" name="destinationAddress" required="" placeholder="Address here">
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
                            <h4 class="modal-title" id="add-modalLabel">Update Destination</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="ps-3 pe-3" action="" method="POST">
                        <div class="modal-body">


                                <div class="mb-3">
                                    @csrf

                                    <input type="hidden" name="type" value="update">
                                    <input type="hidden" name="destID" value="0" id="destID">
                                    <label for="username" class="form-label">Destination Name</label>
                                    <input class="form-control" type="text" id="destinationName" name="destinationName" required="" placeholder="Name here">
                                    <br>
                                    <label for="username" class="form-label">Destination Address</label>
                                    <input class="form-control" type="text" id="destinationAddress" name="destinationAddress" required="" placeholder="Address here">
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
                            <h4 class="modal-title" id="delete-modalLabel">Delete</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="ps-3 pe-3" action="" method="POST">
                        <div class="modal-body">


                                <div class="mb-3">
                                    @csrf
                                    <label for="username" class="form-label">Are you sure, you want to delete this Destination ?</label>
                                    <input type="hidden" name="type" value="delete">
                                    <input type="hidden" name="destID" value="0" id="DeldestID">


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
                            {{-- <script>document.write(new Date().getFullYear())</script> © Velonic - Theme by <b>Techzaa</b> --}}
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
    let destName = document.getElementById('name'+id).innerHTML;
    let destAddress = document.getElementById('address'+id).innerHTML;

    document.getElementById('destinationName').value = destName;
    document.getElementById('destinationAddress').value = destAddress;
    document.getElementById('destID').value = id;
}

function setDataToModelDelete(id){
    document.getElementById('DeldestID').value = id;
}
</script>
