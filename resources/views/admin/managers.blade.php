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

                                <h4 class="page-title">Manager</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->



                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between" >
                                    <h4 class="header-title">Manager List</h4>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add-modal"><i class="ri-add-line"></i> New</button>
                                </div>
                                <div class="card-body">
                                    <table id="datatable-buttons"
                                        class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr class="text-center">
                                                <th>*</th>
                                                <th>Manager</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            @foreach ($managers as $manager)
                                            <tr class="text-center">
                                                <td>{{$loop->count}}</td>
                                                <td id="name{{$manager->id}}">{{$manager->name}}</td>
                                                <td class="txt-center">
                                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit-modal" onclick="setDataToModel({{$manager->id}})" title="Edit"><i class="ri-edit-2-line"></i></button>
                                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal" onclick="setDataToModelDelete({{$manager->id}})" title="Delete"><i class="ri-delete-bin-line"></i></button>
                                                </td>
                                                <input type="hidden" id="managerdata{{$manager->id}}" data-id="{{$manager->id}}" data-name="{{$manager->name}}" data-username="{{$manager->username}}" data-email="{{$manager->email}}" data-password="{{$manager->password}}">

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
                            <h4 class="modal-title" id="add-modalLabel">Adding New Manager</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="ps-3 pe-3" action="{{route('managers.store')}}" method="POST">
                        <div class="modal-body">
                                <div class="mb-3">
                                    @csrf
                                    <div class="row mb-2">
                                        <label for="name" class="form-label">Name</label>
                                        <input class="form-control" type="text" name="name" required="" placeholder="Manager Name here">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="username" class="form-label">Manager Username</label>
                                    <input type="text" name="username" placeholder="Manager Username for Login" class="form-control" name="username">
                                </div>

                                <div class="row mb-2">
                                    <label for="email" class="form-label">Manager Email</label>
                                    <input type="mail" name="email" placeholder="Manager Email here" class="form-control" name="username">
                                </div>

                                <div class="row mb-2">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" placeholder="Manager Password here" class="form-control" name="password">
                                </div>

                        </div>
                        <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button> --}}
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
                            <h4 class="modal-title" id="add-modalLabel">Update Manager</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="ps-3 pe-3" id="editform" method="POST">
                            <div class="modal-body">
                                    <div class="mb-3">
                                        @csrf
                                        <input type="hidden" id="manager_id" name="id">
                                        <div class="row mb-2">
                                            <label for="name" class="form-label">Name</label>
                                            <input class="form-control" type="text" id="name_edit" name="name" required="" placeholder="Manager Name here">
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <label for="username" class="form-label">Manager Username</label>
                                        <input type="text" name="username" placeholder="Manager Username for Login" id="username_edit" class="form-control" name="username">
                                    </div>

                                    <div class="row mb-2">
                                        <label for="email" class="form-label">Manager Email</label>
                                        <input type="mail" name="email" placeholder="Manager Email here" id="email_edit" class="form-control" name="username">
                                    </div>

                                    {{-- <div class="row mb-2">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" placeholder="Manager Password here" id="password_edit" class="form-control" name="password">
                                    </div> --}}

                            </div>
                            <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button> --}}
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
                            <h4 class="modal-title" id="delete-modalLabel">Delete Manager</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="ps-3 pe-3" id="delete-form"  method="POST">
                        <div class="modal-body">


                                <div class="mb-3">
                                    @csrf
                                    <label for="username" class="form-label">Are you sure, you want to delete this manager ?</label>
                                    <input type="hidden" id="manager_id_delete" name="manager_id" >


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
    $('#editform').attr('action','/managers/update/'+id  )
    var managerData = document.getElementById('managerdata' + id);
    var name = managerData.dataset.name;
    var username = managerData.dataset.username;
    var email = managerData.dataset.email;
    // var password = managerData.dataset.password;

    document.getElementById('manager_id').value = id;
    document.getElementById('name_edit').value = name;
    document.getElementById('username_edit').value = username;
    document.getElementById('email_edit').value = email;
    // document.getElementById('password_edit').value = password;



}

function setDataToModelDelete(id){
    $('#delete-form').attr('action','/managers/delete/'+id);
    document.getElementById('manager_id_delete').value = id;
}
</script>
