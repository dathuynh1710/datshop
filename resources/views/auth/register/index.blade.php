@extends('auth.layouts.master')

@section('title')
    Đăng ký tài khoản
@endsection

@section('main-content')
    <h1>Đăng ký tài khoản</h1>
    <div style="position: relative; z-index: 99;">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card mt-4 card-bg-fill">

                    <div class="card-body p-4">
                        <div class="text-center mt-2">
                            <h5 class="text-primary">Tạo mới tài khoản</h5>
                            <p class="text-muted">Tạo tài khoản miễn phí ngay</p>
                        </div>
                        <div class="p-2 mt-4">
                            <form name="frmRegister" method="post" class="needs-validation" novalidate
                                action="{{ route('auth.register.register') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="useremail" class="form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="useremail"
                                        placeholder="Enter email address" required name="email">
                                    <div class="invalid-feedback">
                                        Please enter email
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="username" placeholder="Enter username"
                                        required name="username">
                                    <div class="invalid-feedback">
                                        Please enter username
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="password-input">Password</label>
                                    <div class="position-relative auth-pass-inputgroup">
                                        <input type="password" class="form-control pe-5 password-input" name="password"
                                            onpaste="return false" placeholder="Enter password" id="password-input"
                                            aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                            required>
                                        <button
                                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none"
                                            type="button" id="password-addon"><i
                                                class="ri-eye-fill align-middle"></i></button>
                                        <div class="invalid-feedback">
                                            Please enter password
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Họ <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="last_name" placeholder="Mời nhập họ"
                                        required name="last_name">
                                    <div class="invalid-feedback">
                                        Mời nhập họ
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="first_name" class="form-label">Tên <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="first_name" placeholder="Mời nhập tên"
                                        required name="first_name">
                                    <div class="invalid-feedback">
                                        Mời nhập tên
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="first_name" class="form-label">Giới tính <span
                                            class="text-danger">*</span></label>

                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_1"
                                            value="0">
                                        <label class="form-check-label" for="gender_1">
                                            Nam
                                        </label>
                                    </div>

                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_2"
                                            value="1">
                                        <label class="form-check-label" for="gender_2">
                                            Nữ
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <p class="mb-0 fs-12 text-muted fst-italic">Bằng cách đăng ký tài khoản,
                                        bạn đồng ý các điều khoản sau <a href="#"
                                            class="text-primary text-decoration-underline fst-normal fw-medium">Terms of
                                            Use</a></p>
                                </div>

                                <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                    <h5 class="fs-13">Password must contain:</h5>
                                    <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b></p>
                                    <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter (a-z)</p>
                                    <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b> letter (A-Z)
                                    </p>
                                    <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)</p>
                                </div>

                                <div class="mt-4">
                                    <button class="btn btn-success w-100" type="submit">Đăng ký</button>
                                </div>

                                <div class="mt-4 text-center">
                                    <div class="signin-other-title">
                                        <h5 class="fs-13 mb-4 title text-muted">Create account with</h5>
                                    </div>

                                    <div>
                                        <button type="button"
                                            class="btn btn-primary btn-icon waves-effect waves-light"><i
                                                class="ri-facebook-fill fs-16"></i></button>
                                        <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i
                                                class="ri-google-fill fs-16"></i></button>
                                        <button type="button" class="btn btn-dark btn-icon waves-effect waves-light"><i
                                                class="ri-github-fill fs-16"></i></button>
                                        <button type="button" class="btn btn-info btn-icon waves-effect waves-light"><i
                                                class="ri-twitter-fill fs-16"></i></button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="mt-4 text-center">
                    <p class="mb-0">Already have an account ? <a href="auth-signin-basic.html"
                            class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
                </div>

            </div>
        </div>
    </div>
@endsection
