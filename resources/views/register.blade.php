{{-- @extends('template.tamplateGuest')

@section('title')
<title>Login</title>
@endsection --}}
@extends('template.template')
@section('register')
    <div class="container d-flex justify-content-end mt-5 ">
        <div class="row col-4 ">
            <div class="card">
                <div class="card d-flex justify-content-center mt-3">
                    <h1 class="d-flex justify-content-center">register</h1>
                </div>
                <div class="card-body  d-flex  flex-column justify-content-center border rounded-1 mt-2  py-5 mb-2">
                    @if (Session::has('faild'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="name@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="user123" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="wayan blader" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Nomor telphone</label>
                            <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="087829******" required>
                        </div>
                        
                        <div class="mt-5 ">
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <p>Jika sudah punya akun bisa langsung <a class="text-decoration-none" href="login">Login</a></p>
                </div>
            </div>

        </div>
    </div>
@endsection
