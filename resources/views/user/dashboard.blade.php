@extends('template.templateAdmin')

@section('main')

<div class="card bg-" style="background-color: #1C1717; display:flex; flex-direction:column;">
    <div class="head-card mb-1">Dashboard</div>
    <p>Home>Dashboard</p>
    <div class="container row" style=" ">
        <div class="card col-lg-4 col-md-12">{{ Auth::user() }}</div>
        <div class="card col-lg-4 col-md-12">photo</div>
        <div class="card col-lg-4 col-md-12">photo</div>
        </div>
    
    
</div>

<div class="card flex flex-fill " style="background-color: #1C1717; ">
    <ul>
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Manage Booking</a></li>
        <li><a href="#">Manage Kendaraan</a></li>
        <li><a href="#">Profile</a></li>
    </ul>
    <form action="{{ route('logoutuser') }}" method="POST" class="d-flex" role="search">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">Logout</button>
    </form>
</div>
@endsection

