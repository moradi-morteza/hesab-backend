@extends('layouts.base')
@section('css')
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }
    </style>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row min-vh-100 flex-center g-0">
            <div class="col-lg-8 col-xxl-5 py-3 position-relative"><img class="bg-auth-circle-shape"
                                                                        src="{{asset('template/assets/img/icons/spot-illustrations/bg-shape.png')}}"
                                                                        alt="" width="250"><img
                    class="bg-auth-circle-shape-2"
                    src="{{asset('template/assets/img/icons/spot-illustrations/shape-1.png')}}" alt="" width="150">
                <div class="card overflow-hidden z-index-1">
                    <div class="card-body p-0">
                        <div class="row g-0 h-100">
                            <div class="col-md-6 text-center bg-card-gradient shadow"
                                 style="background-image:url({{asset('template/assets/img/calculator.jpg')}});background-position: 50% 20%; opacity: 0.9">
                                <div class="position-relative p-4 pt-md-5 pb-md-7 light">
                                    <div class="bg-holder bg-auth-card-shape"
                                         style="background-image:url('{{asset('template/assets/img/icons/spot-illustrations/half-circle.png')}}');"></div>

                                </div>
                            </div>
                            <div class="col-md-6 d-flex flex-center">
                                <div class="p-2 p-md-4 flex-grow-1">

                                    @if(session('verification_code_send'))
                                        <div class="card-body p-2">
                                            <div class="z-index-1 position-relative">
                                                <h3 class="link-black font-sans-serif fs-4 d-inline-block fw-bolder">
                                                    RSA</h3>
                                                <p class="fs--1">
                                                    ???? ?????????? ????????
                                                    @if(session('isInitRequest')==false)
                                                        <span class="fw-bold" style="color: red"> ?????????? </span>
                                                    @endif
                                                    ???? ??????????
                                                    <span class="ltr fw-bold">&#x200E;{{session('mobile_received')}}</span>
                                                    ?????????? ????.
                                                </p>
                                            </div>
                                            <form method="POST" class="mt-4" action="{{ route('check-login-mobile-verify') }}">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label" for="split-login-email">???? ?????????? ????????</label>
                                                    <input name="mobile" value="{{session('mobile_received')}}" class="d-none">
                                                    <div class="input-group mb-3">
                                                        <input id="split-login-email" type="number"
                                                               class="form-control ltr  @error('verification_code') is-invalid @enderror"
                                                               name="verification_code"
                                                               value="{{ old('verification_code') }}" required
                                                               autocomplete="verification_code" autofocus>
                                                        <span class="input-group-text ltr" id="basic-addon1">
                                                        <span class="fas fa-mobile-alt"></span>
                                                    </span>
                                                    </div>


                                                    @if ($errors->any())
                                                        <ul class="rtl m-0 p-0">
                                                            @foreach ($errors->all() as $error)
                                                                <span style="color: red" class="fs--1">{{ $error }}</span>
                                                            @endforeach
                                                        </ul>
                                                    @endif

                                                </div>
                                                <div class="mb-3">
                                                    <button class="btn btn-primary d-block w-100 mt-3" type="submit"
                                                            name="submit">?????????? ????
                                                    </button>
                                                </div>

                                                <p class="fs--2 mb-0">???? ?????????? ???? ???? ???????? ?????? ?????????? ???????? ?????????? ?????????????? ????????.</p>

                                            </form>


                                                <form method="POST" action="{{ route('request-mobile-verify-code') }}">
                                                    @csrf
                                                    <input name="mobile" value="{{session('mobile_received')}}" class="d-none">
                                                    <button

                                                        type="submit"
                                                        id="resend-button"
                                                        disabled
                                                        class="btn btn-outline-primary btn-sm d-block w-100 mt-1 mb-3">

                                                    <span id="counter-text">
                                                        <span>???????? ???????? ?????????? ???? ?????????????? ???????? :</span>
                                                        <span id="timer"></span>
                                                    </span>
                                                        <span id="resend-text" style="display: none">?????????????? ???????? ????</span>
                                                    </button>
                                                </form>

                                                <a class="mt-6 fs--1" href="/login">???????????? ?????????? ????????????</a>



                                        </div>
                                    @else
                                        <div class="card-body p-2">
                                            <div class="z-index-1 position-relative">
                                                <h3 class="link-black font-sans-serif fs-4 d-inline-block fw-bolder">
                                                    RSA</h3>
                                                <p class="opacity-75 text-black">
                                                    ???????? ????
                                                    ???????????????? ????????</p>
                                            </div>
                                            <form method="POST" class="mt-4" action="{{ route('login-mobile') }}">
                                                @csrf
                                                <div class="">

                                                    <label class="form-label" for="split-login-email">?????????? ???????? ??????????</label>
                                                    <input name="code" value="+98" class="d-none">
                                                    <div class="input-group mb-1">
                                                        <input id="split-login-email" type="number"
                                                               class="form-control ltr  @error('mobile') is-invalid @enderror"
                                                               name="mobile" value="{{ old('mobile') }}" required
                                                               placeholder="9"
                                                               autocomplete="mobile" autofocus>
                                                        <span class="input-group-text ltr" id="basic-addon1">+98</span>

                                                    </div>
                                                    <span class="fs--2">?????????? ???????? ?????????? ???? ???????? ?????? ?????? ???????? ????????.</span>


                                                    @if ($errors->any())
                                                        <ul class="rtl m-0 p-0">
                                                            @foreach ($errors->all() as $error)
                                                                <span style="color: red" class="fs--1">{{ $error }}</span>
                                                            @endforeach
                                                        </ul>
                                                    @endif

                                                </div>
                                                <div class="mb-3">
                                                    <button class="btn btn-primary d-block w-100 mt-3" type="submit"
                                                            name="submit">???????? ???? ?????? ??????
                                                    </button>
                                                </div>
                                                <p class="fs--1">?????? ???? ???????????? ???? ???????? ?????????? ?????????? ???? ???? ?????????? ?????? ??????
                                                    ???? ???????? ???? ?????????? ????????.</p>
                                                <a class="btn btn-danger btn-sm pb-1 d-block w-100" href="#">
                                                <span class="fab align-middle fa-google-plus-g"
                                                      data-fa-transform="grow-8"></span>
                                                    <span class="mx-2">???????? ???? ?????? ?????? ???? ????????</span>
                                                </a>
                                            </form>
                                        </div>
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@if(session('verification_code_send'))

    @push('js')
        <script>
            let timerOn = true;

            function timer(remaining) {
                var m = Math.floor(remaining / 60);
                var s = remaining % 60;

                m = m < 10 ? '0' + m : m;
                s = s < 10 ? '0' + s : s;
                document.getElementById('timer').innerHTML = m + ':' + s;
                remaining -= 1;

                if (remaining >= 0 && timerOn) {
                    setTimeout(function () {
                        timer(remaining);
                    }, 1000);
                    return;
                }

                if (!timerOn) {
                    // Do validate stuff here
                    return;
                }


                // Do timeout stuff here
                $("#resend-button").prop('disabled', false);
                $("#counter-text").hide()
                $("#resend-text").show()

            }

            timer(60);
        </script>

    @endpush
@endif
