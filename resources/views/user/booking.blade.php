@extends('template.templateUser')
@section('main')
<div class="container">
    <h1>Daftar Bookings</h1>
    @foreach($booking as $bookings)
    
        <h2>Booking ID: {{ $bookings->booking_id }}</h2>
        <div class="">
            <img src="{{ $bookings->admin_photo}}" alt="" >
        </div>card
        <p><b>Nama  : </b>{{$bookings->admin_name}}</p>
        <p><b>Nama  : </b>{{$bookings->status}}</p>
        <p><b>Nama  : </b>{{ $bookings->price_total_booking}}</p>
        <ul>        
                <li></li> <!-- Ganti dengan nama field yang sesuai -->
                <!-- Tampilkan lebih banyak detail sesuai kebutuhan Anda -->
        </ul>
    @endforeach
@endsection