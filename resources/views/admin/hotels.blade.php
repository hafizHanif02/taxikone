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
                            <div class="card-header d-flex justify-content-between">
                                <h4 class="header-title">Hotel List</h4>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add-modal"><i
                                        class="ri-add-line"></i> New</button>
                            </div>
                            <div class="card-body" style="overflow: scroll;">
                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Hote Name</th>
                                            <th>Controller Username</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach ($hotels as $htl)
                                            <tr>
                                                <td id="hotelID"{{ $htl->id }}>{{ $htl->id }}</td>
                                                <td id="name{{ $htl->id }}">{{ $htl->name }}</td>
                                                <td
                                                @if($htl->manager)
                                                 id="userID{{ $htl->manager->id }}">{{ $htl->manager->name }}
                                                @endif
                                            </td>
                                                <td id="address{{ $htl->id }}">{{ $htl->address }}</td>
                                                <input type="hidden" id="hoteldata" data-hotel_name="{{$htl->name}}" data-hotel_address="{{$htl->address}}" data-hotel_manager_id="{{$htl->manager->id}}" data-hotel_manager_name="{{$htl->manager->name}}">
                                                <td>
                                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit-modal" onclick="setDataToModel({{ $htl->id }})" title="Edit"><i
                                                            class="ri-edit-2-line"></i></button>
                                                    <a href="{{route('hotels.delete',$htl->id)}}"><button class="btn btn-danger"><i class="ri-delete-bin-line"></i></button></a>
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
        <div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add-modalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="add-modalLabel">Adding New Hotel</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="ps-3 pe-3" action="{{route('hotels.store')}}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                @csrf
                                <div class="row mb-2">
                                    <label for="username" class="form-label">Hotel Name</label>
                                    <input type="hidden" name="type" value="new">


                                    <input type="hidden" name="hotelID">
                                    <input class="form-control" type="text" name="hotelName" required=""
                                        placeholder="hotel Name here">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="username" class="form-label">Hotel Address</label>
                                <input type="text" placeholder="hotel address here" class="form-control" name="address">
                            </div>

                            <div class="row mb-2">
                                <label for="username" class="form-label">Hotel Manager</label>
                                <select name="user_id" id="user_id" name="user_id" class="form-control">
                                    <option value="" disabled selected>Select Manager</option>
                                    @foreach ($managers as $manager)
                                        <option class="form-label" value="{{ $manager->id }}">{{ $manager->name }}
                                        </option>
                                    @endforeach
                                </select>
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
        {{-- Models end here --}}

        <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add-modalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="add-modalLabel">Update hotel</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="ps-3 pe-3" id="updateform"  method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                @csrf
                                <div class="row mb-2">
                                    <label for="username" class="form-label">Hotel Name</label>
                                    <input type="hidden" name="type" value="new">


                                    <input type="hidden" name="hotelID" id="hotel_id_edit">
                                    <input class="form-control" type="text" id="hotel_name_edit" id="hotelName" name="hotelName" required=""
                                        placeholder="hotel Name here">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="username" class="form-label">Hotel Address</label>
                                <input type="text" placeholder="hotel address here" id="hotel_address_edit" class="form-control" name="address">
                            </div>

                            <div class="row mb-2">
                                <label for="username" class="form-label">Hotel Manager</label>
                                <select name="user_id" id="user_id" name="user_id" class="form-control">
                                    <option value="" disabled selected>Select Manager</option>
                                    @foreach ($managers as $manager)
                                        <option class="form-label" value="{{ $manager->id }}">{{ $manager->name }}
                                        </option>
                                    @endforeach
                                </select>
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

        <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete-modalLabel"
            aria-hidden="true">
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
                                <label for="username" class="form-label">Are you sure, you want to delete this hotel
                                    ?</label>
                                <input type="hidden" name="type" value="delete">
                                <input type="hidden" id="hotelIDDelete" name="hotelID" id="hotelID">


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
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Velonic - Theme by <b>Techzaa</b>
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
    function setDataToModel(id) {
        let hotelName = document.getElementById('name' + id).innerHTML;
        let hoteladdress = document.getElementById('address' + id).innerHTML;
        $('#updateform').attr('action','/hotels/update/'+id);
        document.getElementById('hotel_name_edit').value = hotelName;
        document.getElementById('hotel_address_edit').value = hoteladdress;
        document.getElementById('hotel_id_edit').value = id;
    }

    function setDataToModelDelete(id) {
        document.getElementById('hotelIDDelete').value = id;
    }
</script>
