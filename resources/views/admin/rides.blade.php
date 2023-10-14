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

                                <h4 class="page-title">Rides</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->



                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header text-end">
                                   <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#add-modal">Add Ride</button>
                                </div>
                                <div class="card-body">
                                    <table id="datatable-buttons"
                                        class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr class="text-center">

                                                <th>Driver</th>
                                                <th>Hotel</th>
                                                <th>Destination</th>
                                                <th>Destination Address</th>
                                                <th>Date</th>
                                                <th>Commission Amount</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            @foreach($rides as $ride)
                                            <tr class="text-center">
                                                
                                                <td>
                                                    {{$ride->driver->name}}
                                                    <input required type="hidden" class="hotel_name{{$ride->id}}" value="{{$ride->driver->name}}">
                                                </td>
                                                <td>
                                                    {{$ride->hotel->name}}
                                                    <input required type="hidden" class="hotel_name{{$ride->id}}" value="{{$ride->hotel->name}}">
                                                </td>
                                                <td>
                                                    {{$ride->destination->name}}
                                                    <input required type="hidden" class="destination_name{{$ride->id}}" value="{{$ride->destination->name}}">
                                                </td>
                                                <td>
                                                    {{$ride->destination->address}}
                                                    <input required type="hidden" class="destination_address{{$ride->id}}" value="{{$ride->destination->address}}">
                                                </td>
                                                <td>
                                                    {{$ride->ride_date}}
                                                    <input required type="hidden" class="ride_date{{$ride->id}}" value="{{$ride->ride_date}}">

                                                </td>
                                                <td>
                                                    {{$ride->comission_rate}}
                                                    <input required type="hidden" class="ride_commission_amount{{$ride->id}}" value="{{$ride->comission_rate}}">

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



        </div>



        {{-- MODEL START --}}
        <div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="add-modalLabel">Adding New Ride</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="ps-3 pe-3" action="{{route('ride.store')}}" method="POST">
                    <div class="modal-body">
                        @csrf
                            <div class="mb-3">

                            </div>
                            <div class="mb-3">
                                <div class="row mb-2">
                                    <label for="customer_name" class="form-label">Choose Driver</label>
                                    <select required class="form-control" name="driver_id" id="driver_id">
                                        <option value="" selected disabled >What is your Driver</option>
                                        @foreach($drivers as $driver)
                                        <option value="{{$driver->id}}">{{$driver->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="hotel_id" class="form-label">Choose Your Hotel </label>
                                <select required class="form-control" name="hotel_id" id="hotel_id">
                                    <option value="" selected disabled >What is your Hotel</option>
                                    @foreach($hotels as $hotel)
                                    <option value="{{$hotel->id}}">{{$hotel->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row mb-2">
                                <label for="destination_id" class="form-label">Choose Destination</label>
                                <select required class="form-control" name="destination_id" id="destination_id">
                                    <option value="" selected disabled >What is your Destination</option>
                                    @foreach($destinations as $destination)
                                    <option value="{{$destination->id}}">{{$destination->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row mb-2">
                                <label for="destination_id" class="form-label">Commission Amount</label>
                                <input required type="text" readonly id="commission_amount" name="comission_rate" class="form-control" >
                            </div>
                            <div class="row mb-2">
                                <label for="ride_date" class="form-label">Ride Date</label>
                                <input required type="date" placeholder="Ride Date here" value="{{ date('Y-m-d') }}" class="form-control" name="ride_date">
                            </div>
                            {{-- <div class="row mb-2">
                                <label for="ride_time" class="form-label">Ride Time</label>
                                <input required type="time" placeholder="Ride Time password here" class="form-control" name="ride_time">
                            </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        {{-- MODEL END --}}




        {{-- OPEN RIDE MODEL --}}
        <div id="open-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="add-modalLabel">Open Ride</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div class="mb-3">
                                @csrf

                                <table class="table table-bordered">

                                    <tr>
                                        <th>Guest Of (Hotel)</th>
                                        <td><span class="open_ride_hotel_name"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Destination </th>
                                        <td><span class="open_ride_destination_name"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Date </th>
                                        <td><span class="open_ride_date"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Time </th>
                                        <td><span class="open_ride_time"></span></td>
                                    </tr>
                                </table>

                                <form class="ps-3 pe-3" action="{{route('ride.store')}}" method="POST">
                                    <input required type="hidden" name="ride_id" class="ride_id">
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <label for="driver_id">Assign Driver</label></label><span class="text-danger">*</span>
                                            <select required class="form-control" name="driver_id" id="driver_id">
                                                <option value="" selected disabled>Choose Driver</option>
                                                @foreach($drivers as $driver)
                                                <option value="{{$driver->id}}">{{$driver->name}}</option>
                                                @endforeach
                                         </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3 mt-3">
                                        <div class="col-md-6">
                                            <label for="commission_amount">Commsison Amount</label><span class="text-danger">*</span>
                                            <input required class="form-control" placeholder="Enter Commission" type="number" name="commission_amount" value="0" onkeyup="CommissionAmount()" id="commission_amount">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="hotel_commission_amount">Hotel Commsison Amount</label></label><span class="text-danger">*</span>
                                            <input required class="form-control" id="hotel_commission_amount" type="number" placeholder="Enter Hotel Commission" onkeyup="HotelCommissionAmount()" value="0" id="hotel_commission_amount" name="hotel_commission_amount">
                                        </div>
                                    </div>
                                    <div class="row mb-3 mt-3">
                                        <div class="col-md-12">
                                            <label for="total_amount">Ride Fee</label></label><span class="text-danger">*</span>
                                            <input required type="numnber" value="0" name="ride_fee" id="ride_fee" onkeyup="Fee()" class="form-control" placeholder="Enter Ride Fees" >
                                        </div>
                                    </div>
                                    <div class="row mb-3 mt-3">
                                        <div class="col-md-12">
                                            <label for="total_amount">Total Cost</label>
                                            <input required type="numnber" value="0" readonly  name="total_cost" id="total_cost" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-dark">Save</button>
                                    </div>
                             </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        {{-- OPEN RIDE MODEL END --}}
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <script>
            function OpenRide(id){
                var customerName = $('.customer_name'+id).val()
                $('.open_ride_customer_name').html(customerName+'<br>');
                var hotelName = $('.hotel_name'+id).val()
                $('.open_ride_hotel_name').html(hotelName+'<br>');
                var destinationName = $('.destination_name'+id).val()
                $('.open_ride_destination_name').html(destinationName+'<br>');
                var RideDate = $('.ride_date'+id).val()
                $('.open_ride_date').html(RideDate+'<br>');
                var RideTime = $('.ride_time'+id).val()
                $('.open_ride_time').html(RideTime+'<br>');
                $('.ride_id').val(id);

            }

            function CommissionAmount(){
                // var totalCost =  $('#total_cost').val();
                var CommissionAmount =  $('#commission_amount').val();
                // var total_amount = parseFloat(totalCost)+parseFloat(CommissionAmount);
                $('#total_cost').val(CommissionAmount);
                HotelCommissionAmount();
            }

            function HotelCommissionAmount(){
                var totalCost =  $('#total_cost').val();
                var HotelCommissionAmount =  $('#hotel_commission_amount').val();
                var total_amount = parseFloat(totalCost)+parseFloat(HotelCommissionAmount);
                $('#total_cost').val(total_amount);
                Fee();
            }
            function Fee(){
                var totalCost =  $('#total_cost').val();
                var RideFee =  $('#ride_fee').val();
                var total_amount = parseFloat(RideFee)+parseFloat(totalCost);
                $('#total_cost').val(total_amount);
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#hotel_id, #destination_id').change(function() {
                    var hotelId = $('#hotel_id').val();
                    var destinationId = $('#destination_id').val();

                    if (hotelId && destinationId) {
                        $.get('/get-commission-rate', { hotel_id: hotelId, destination_id: destinationId }, function(data) {
                            if (data.commission_rate) {
                                $('#commission_amount').val(data.commission_rate);
                            } else {
                                $('#commission_amount').val('Commission rate not found');
                            }
                        });
                    } else {
                        $('#commission_amount').val('');
                    }
                });
            });
        </script>
@endsection
