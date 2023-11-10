@extends('template.templateUser')
@section('main')    

<div class="section">
    <div class="card row col-6 offset-3 ">
        <div class="col">
            <h1 class=" text-center">Tiket Booking</h1>
        </div>
        <div class="col d-flex flex-column justify-content-center gap-2">
            <div class="card col-10">
            <p><span style="font-weight: bold;">Nama Pemesan :</span> {{ Auth::user()->name}}</p>
            </div>
            @foreach ($ticket as $tickets)
            <div class="card col-10">
                <p><span style="font-weight: bold;">Nama Kendaraan :</span> {{ $tickets->vehicle->name }}</p>
                <p><span style="font-weight: bold;">Jumlah Kendaraan :</span> {{ $tickets->qty }}</p>
                <p><span style="font-weight: bold;">Tanggal Pengambilan :</span> {{ $tickets->pickup_date }}</p>
                <p><span style="font-weight: bold;">Tanggal Pengembalian :</span> {{ $tickets->return_date }}</p>
                <p><span style="font-weight: bold;">Harga Sewa :</span> {{ $tickets->price_total_charter }}</p>
            </div>
            @endforeach
            <div class="card col-10">
                <p class=" text-center"><span style="font-weight: bold;">Total Harga Sewa :</span> {{ $booking->price_total_booking }}</p>
            </div>
        </div>

    </div>
</div>
@endsection