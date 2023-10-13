@extends('controller.layout') <!-- Extend the layout file -->

@section('title', 'Payment List') <!-- Define the title -->

@section('content') <!-- Fill in the content section -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
            <div class="content">
                {{-- {{dd($hotelData) }} --}}

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">

                                <h4 class="page-title">Payments</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->



                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between" >
                                    <h4 class="header-title">Payment List</h4>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add-modal"><i class="ri-add-line"></i> New</button>
                                </div>
                                <div class="card-body">
                                   
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button class="btn btn-primary accordion-button collapsed" type="button"  data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                        Driver Payments
                                                    </button>
                                                </div>
                                                <div class="col-md-6">
                                                    <button class="btn btn-primary accordion-button collapsed" type="button"  data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                        Hotel Payments
                                                    </button>
                                                </div>
                                            </div>
                                          <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th>#</th>
                                                            <th>Driver</th>
                                                            <th>Ride</th>
                                                            <th>Total Comission</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($driverDatas as $driverData)
                                                        {{-- {{dd($driverData) }} --}}
                                                        <tr class="text-center">
                                                            <td>{{$loop->iteration }}</td>
                                                            <td>{{$driverData->driver->name}}</td>
                                                            <td>{{$driverData->number_of_rides}}</td>
                                                            
                                                            <td>{{ number_format($driverData->balance_comission, 2) }}</td>
                                                            <td>
                                                                @if ($driverData->balance_comission != 0)
                                                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"  onclick="addpayment({{$driverData->driver->id}})">PAY</button>
                                                                @else
                                                                <button class="btn btn-success" disabled>PAID</button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>


                                                {{-- PAYMENT MODEL DRIVER --}}
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Payments</h5>
                                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                          ADD PAYMENT
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                          <form action="" id="payment_form" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" id="payment_form_input">
                                                              <button type="submit" class="btn btn-primary">Save changes</button>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                {{-- END PAYMENT MODEL --}}



                                                


                                            </div>
                                          </div>
                                        </div>
                                        <div class="accordion-item">
                                          <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th>#</th>
                                                            <th>Hotel</th>
                                                            <th>Total Ride</th>
                                                            <th>Total Commission</th>
                                                            <th>Payable Ride</th>
                                                            <th>Payable Commission</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        @foreach ($hotelDatas as $hotelData)
                                                        <tr class="text-center">
                                                            <td>{{$loop->iteration }}</td>
                                                            <td>{{$hotelData->hotel->name}}</td>
                                                            <td>{{$hotelData->pay_ride}}</td>
                                                            <td>{{ number_format($hotelData->pay_amount, 2) }}</td>
                                                            <td>{{$hotelData->payable_ride}}</td>
                                                            <td>{{ number_format($hotelData->payable_amount, 2) }}</td>
                                                            <td>
                                                                @if ($hotelData->payable_amount != 0)
                                                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalhotel"  onclick="addpaymenthotel({{$hotelData->hotel->id}})">PAY</button>
                                                                @else
                                                                <button class="btn btn-success" disabled>PAID</button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>




                                                 {{-- PAYMENT MODEL HOTEL --}}
                                                 <div class="modal fade" id="exampleModalhotel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Payments</h5>
                                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                          ADD PAYMENT HOTEL
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                          <form action="" id="payment_form_hotel" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" id="payment_form_hotel_input">
                                                              <button type="submit" class="btn btn-primary">Save changes</button>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                {{-- END PAYMENT MODEL --}}

                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div> <!-- end row-->


                </div> <!-- container -->

            </div> <!-- content -->


            {{-- Models start here --}}
            <!-- Standard modal content -->
           
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
        <script>
            function addpayment(id){
                console.log(id);
                $('#payment_form').attr('action', '/add_paymentc/' + id);
                $('#payment_form_input').val(id);
            }
            function addpaymenthotel(id) {
                $('#payment_form_hotel').attr('action', '/add_payment_hotelc/' + id); // Remove '/controller' from here
                $('#payment_form_hotel_input').val(id);
            }
        </script>
@endsection



