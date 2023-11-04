{{-- @extends('template.tamplateGuest')

@section('title')
<title>Login</title>
@endsection --}}
@extends('template.template')
@section('login')
    <div class="container d-flex justify-content-end mt-5 ">
        <div class="row col-4 ">
            <div class="card">
                <div class="card d-flex justify-content-center mt-3">
                    <h1 class="d-flex justify-content-center">LOGIN</h1>
                </div>
                <div class="card-body  d-flex  flex-column justify-content-center border rounded-1 mt-2  py-5 mb-2">
                    @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}">
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
                       <div div class="mb-3 d-flex justify-content-end gap-2 p-2">
                            <label for="loginAdmin">Login Sebagai Admin</label>
                            <input type="checkbox" name="admin" value="true" id="loginAdmin">
                        </div>
                        <div class="mt-5 ">
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary text-">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <p>jika belum mempunyai akun silakan lakukan <a class="text-decoration-none" href="register">register</a></p>
                </div>
            </div>

        </div>
    </div>
@endsection
