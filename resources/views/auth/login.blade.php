@extends('layouts.base')

@section('content')


        <div class="container-fluid">
            <div class="row min-vh-100 flex-center g-0">
                <div class="col-lg-8 col-xxl-5 py-3 position-relative"><img class="bg-auth-circle-shape" src="{{asset('template/assets/img/icons/spot-illustrations/bg-shape.png')}}" alt="" width="250"><img class="bg-auth-circle-shape-2" src="{{asset('template/assets/img/icons/spot-illustrations/shape-1.png')}}" alt="" width="150">
                    <div class="card overflow-hidden z-index-1">
                        <div class="card-body p-0">
                            <div class="row g-0 h-100">

                                <div class="col-md-5 text-center bg-card-gradient shadow"
                                     style="background-image:url({{asset('template/assets/img/rsa/tech2.jpg')}});background-position: 50% 20%; opacity: 0.9">
                                    <div class="position-relative p-4 pt-md-5 pb-md-7 light">
                                        <div class="bg-holder bg-auth-card-shape" style="background-image:url('{{asset('template/assets/img/icons/spot-illustrations/half-circle.png')}}');"></div>

                                    </div>
                                </div>
                                <div class="col-md-7 d-flex flex-center">
                                    <div class="p-2 p-md-5 flex-grow-1">
                                        <div class="card-body p-2">
                                            <div class="z-index-1 position-relative">
                                                <h3 class="link-black font-sans-serif fs-4 d-inline-block fw-bolder" >RSA</h3>
                                                <p class="opacity-75 text-black">
                                                    ورود به
                                                    سیستم مدیریت تعمیرگاه</p>
                                            </div>
                                            <form method="POST" class="mt-4" action="{{ route('login') }}">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label" for="split-login-email">ایمیل یا نام کاربری</label>
                                                    <input id="split-login-email" type="text" class="form-control ltr @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                    @error('email')
                                                    <span class="invalid-feedback my-2" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <div class="d-flex justify-content-between">
                                                        <label class="form-label" for="split-login-password">رمز عبور</label>
                                                    </div>
                                                    <input id="split-login-password" type="password" class="form-control ltr @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                    @error('password')
                                                    <span class="invalid-feedback my-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror

                                                </div>
                                                <div class="row flex-between-center">
                                                    <div class="col-auto">
                                                        <div class="form-check mb-0">
                                                            <input class="form-check-input" type="checkbox" name="remember" id="split-checkbox" {{ old('remember') ? 'checked' : '' }}>

                                                            <label class="form-check-label mb-0" for="split-checkbox">مرا به خاطر داشته باش</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto"><a class="fs--1" href="">فراموشی رمز عبور</a></div>
                                                    {{--                                    {{ route('password.request') }}--}}
                                                </div>
                                                <div class="mb-3">
                                                    <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">ورود</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>








@endsection
