<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>TaxiKone | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Theme Config Js -->
    <script src="assets/js/config.js"></script>

    <!-- App css -->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg position-relative">
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-8 col-lg-10">
                    <div class="card overflow-hidden">
                        <div class="row g-0">

                            <div class="col-lg-12">
                                <div class="d-flex flex-column h-100">
                                    <div class="auth-brand p-4">
                                        <a href="index.html" >
                                            <img src="assets/images/logo.png" alt="logo" height="22"><span style="
                                            font-size: 20px;
                                            font-weight: bold;
                                            font-family: cursive;
                                            color: red;
                                        ">Taxi<i style="
    font-style: italic;
    color: #ffc300;
">Kone</i></span>
                                        </a>

                                    </div>
                                    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                                    <div class="p-4 my-auto">
                                        <h4 class="fs-20">Sign In</h4>
                                        <p class="text-muted mb-3">Enter your email address and password to access
                                            account.
                                        </p>

                                        <!-- form -->
                                        <form  method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="emailaddress" class="form-label">User Name</label>
                                                <input class="form-control" type="text" name="userName" required=""
                                                    placeholder="Enter your username">
                                            </div>
                                            <div class="mb-3">
                                                <a href="auth-forgotpw.html" class="text-muted float-end"><small>Forgot
                                                        your
                                                        password?</small></a>
                                                <label for="password" class="form-label">Password</label>
                                                <input class="form-control" type="password" required="" name="password"
                                                    placeholder="Enter your password">
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input"
                                                        id="checkbox-signin">
                                                    <label class="form-check-label" for="checkbox-signin">Remember
                                                        me</label>
                                                </div>
                                            </div>
                                            <div class="mb-0 text-start">
                                                <button class="btn btn-soft-primary w-100" type="submit"><i
                                                        class="ri-login-circle-fill me-1"></i> <span class="fw-bold">Log
                                                        In</span> </button>
                                            </div>


                                        </form>
                                        <!-- end form-->
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>

        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt fw-medium">
        <span class="text-dark">
            <script>document.write(new Date().getFullYear())</script> © TaxiKone
        </span>
    </footer>
    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>

</html>
