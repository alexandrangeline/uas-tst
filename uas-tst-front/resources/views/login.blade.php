@extends('layouts.master') 
@section('konten')
<section class="login">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-md-6" align="center">
                            <img
                                src="{{ asset('vendor') }}/images/virus.png"
                                class="img-fluid"
                                width="50%"
                            />
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('login-account')}}" class="p-4" method="POST">
                                @csrf
                                <h3 class="pb-4">Login Account</h3>
                                @if($m = Session::get('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $m }}.
                                </div>
                                @endif
                                @if($m = Session::get('sukses'))
                                <div class="alert alert-success" role="alert">
                                    {{ $m }}.
                                </div>
                                @endif
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            class="input-group-text"
                                            id="email"
                                            ><i class="fa fa-envelope"></i
                                        ></span>
                                    </div>
                                    <input
                                        type="email"
                                        class="form-control"
                                        name="email"
                                        required
                                        placeholder="Masukan email, ex: udin@gmail.com"
                                        aria-describedby="email"
                                    />
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            class="input-group-text"
                                            id="password"
                                            ><i class="fa fa-lock"></i
                                        ></span>
                                    </div>
                                    <input
                                        type="password"
                                        minlength="8"
                                        class="form-control"
                                        name="password"
                                        required
                                        placeholder="Masukan password"
                                        aria-describedby="password"
                                    />
                                </div>
                                <button
                                    class="btn btn-custom mb-2"
                                    type="submit"
                                >
                                    Login
                                </button>
                                <p>
                                    Belum punya akun?
                                    <a href="{{ url('/register') }}"
                                        >Register Now!</a
                                    >
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
