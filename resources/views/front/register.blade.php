@extends('front.front_layouts')

@section('content')
<div class="auth-page-wrapper pt-5">
    <!-- auth page bg -->
    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>

    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                        <div>
                            <a href="index.html" class="d-inline-block auth-logo">
                                <img src="assets/images/logo-light.png" alt="" height="20">
                            </a>
                        </div>
                        <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Create New Account</h5>
                                <p class="text-muted">Get your free HiQ Africa account now</p>
                            </div>
                            <div class="p-2 mt-4">
                                {!! Form::open(['url' => '','class'=> ' ajax-form', 'id'=>'ajax-register-form', 'method' => 'POST']) !!}
                                <div>
                                    <div id="alert"></div>
                                </div>
                                <div class="register-div">
                                    <div class="flex flex-wrap -m-2 mb-6">
                                        <div class="form-group w-full p-2">
                                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                            <input class="form-control "
                                                type="text" placeholder="{{ $frontSetting->register_company_name_text }}" id="company_name" name="company_name">
                                        </div>



                                        <div class="form-group w-full p-2">
                                            <label for="useremail" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input class="form-control"
                                                type="text" placeholder="{{ $frontSetting->register_email_text }}" id="company_email" name="company_email" value="{{ $actionEmail }}">
                                        </div>
                                        <div class="form-group w-full p-2">
                                            <label class="form-label" for="password-input">Password</label>
                                            <input class="form-control pe-5 password-input"
                                                type="password" placeholder="{{ $frontSetting->register_password_text }}" id="password" name="password">
                                        </div>
                                        <div class="form-group w-full p-2">
                                            <label class="form-label" for="password-input">Re-type Password</label>
                                            <input class="form-control pe-5 password-input"
                                                type="password" placeholder="{{ $frontSetting->register_confirm_password_text }}" id="confirm_password" name="confirm_password">
                                        </div>
                                    </div>

                                    <input class="form-control"  type="checkbox" id="condition" name="condition" style="" checked hidden>

                                    <div class="mb-4">
                                        <p class="mb-0 fs-12 text-muted fst-italic">By registering you agree to the HiQ Africa <a href="#" class="text-primary text-decoration-underline fst-normal fw-medium">Terms of Use</a></p>
                                    </div>
                                    <div class="mt-4">
                                        <button class="btn btn-primary w-100"  type="submit" onclick="register();return false">Sign Up</button>
                                    </div>
                                </div>



                                </div>
                                {{Form::close()}}

                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="mt-4 text-center">
                        <p class="mb-0">Already have an account ? <a href="/admin/login" class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">&copy;
                            <script>document.write(new Date().getFullYear())</script> HiQ Africa.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>
<!-- end auth-page-wrapper -->
@endsection


@section('scripts')
    <script>
        "use strict";

        function register() {
            art.sendXhr({
                url: "{{route('front.register.save')}}",
                type: "POST",
                file: true,
                container: "#ajax-register-form",
                disableButton: true,
                messageLocation: 'inline',
                success: function(response) {
                    if(response.status == 'success'){
                        $('.register-div').remove();
                    }
                }
            });
        }
    </script>

 <!-- JAVASCRIPT -->
 <script src="http://127.0.0.1:8000/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
 <script src="http://127.0.0.1:8000/assets/libs/simplebar/simplebar.min.js"></script>
 <script src="http://127.0.0.1:8000/assets/libs/node-waves/waves.min.js"></script>
 <script src="http://127.0.0.1:8000/assets/libs/feather-icons/feather.min.js"></script>
 <script src="http://127.0.0.1:8000/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
 <script src="http://127.0.0.1:8000/assets/js/plugins.js"></script>

 <!-- particles js -->
 <script src="http://127.0.0.1:8000/assets/libs/particles.js/particles.js"></script>
 <!-- particles app js -->
 <script src="http://127.0.0.1:8000/assets/js/pages/particles.app.js"></script>
 <!-- validation init -->
 <script src="http://127.0.0.1:8000/assets/js/pages/form-validation.init.js"></script>
 <!-- password create init -->
 <script src="http://127.0.0.1:8000/assets/js/pages/passowrd-create.init.js"></script>
@endsection



<style>

@import 'http://127.0.0.1:8000/assets/css/bootstrap.min.css';
@import 'http://127.0.0.1:8000/assets/css/icons.min.css';
@import 'http://127.0.0.1:8000/assets/css/app.min.css';
@import 'http://127.0.0.1:8000/assets/css/custom.min.css';
</style>
