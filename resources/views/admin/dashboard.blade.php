@extends('template.templateAdmin')
@section('dashboard', 'active')

@section('main')
    <section class="row gap-4 me-2">

        {{-- Section header Body --}}
        <div class="card row shadow" style="background-color: #F5F5F5;">
            <div class="col-12 head-card mb-3 mt-1">
                <h2>Dashboard</h2>
                <p><a href="/" class="text-black text-decoration-none">Home</a> > <a href="/"
                        class="text-decoration-none text-gray-900">Dashboard</a></p>
            </div>
            <div class="container d-flex flex-wrap justify-content-between gap-3" style="height: 200px">
                <div class="card mb-3 flex-grow-1 borde-0 shadow"> <!-- Menggunakan flex-grow untuk memungkinkan penyesuaian otomatis -->
                    <header class="card-header ">Stok Kendaraan</header>
                    <div class="card-body">
                        <p class="card-text">{{ $sum }}</p>
                    </div>
                </div>
                <div class="card mb-3 flex-grow-1 borde-0 shadow"> <!-- Menggunakan flex-grow untuk memungkinkan penyesuaian otomatis -->
                    <header class="card-header ">Stok Kendaraan</header>
                    <div class="card-body">
                        <p class="card-text">{{ $sum }}</p>
                    </div>
                </div>
                <div class="card mb-3 flex-grow-1 borde-0 shadow"> <!-- Menggunakan flex-grow untuk memungkinkan penyesuaian otomatis -->
                    <header class="card-header ">Stok Kendaraan</header>
                    <div class="card-body">
                        <p class="card-text">{{ $sum }}</p>
                    </div>
                </div>
            </div>
        </div>



        <div class="card row d-flex shadow  px-0 pb-2" style="background-color: #F5F5F5; ">
            <div class="card-header d-flex bg-primary text-bg-primary  justify-content-between">
                <h2> Booking</h2>
                
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $rowNumber = 1; // Inisialisasi nomor baris
                    @endphp
                    @foreach ($bookings as $booking)
                        <tr>
                            <th scope="row">{{ $rowNumber++ }}</th>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ $booking->price_total_booking }}</td>
                            <td>{{ $booking->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-end mt-3"> <!-- Atur posisi sesuai kebutuhan -->
                <a class="text-bg-info text-decoration-none" href="/booking">
                    <h5>Selengkapnya</h5>
                </a>
            </div>
        </div>
        <div class="card row d-flex shadow  px-0 pb-2" style="background-color: #F5F5F5; ">
            <div class="card-header d-flex bg-primary text-bg-primary  justify-content-between">
                <h2> Kendaraan</h2>
               
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Kendaraan</th>
                        <th scope="col">Tipe</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Harga Sewa</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $rowNumber = 1; // Inisialisasi nomor baris
                    @endphp
                    @foreach ($vehicles as $vehicle)
                        <tr>
                            <th scope="row">{{ $rowNumber++ }}</th>
                            <td>{{ $vehicle->name}}</td>
                            <td>{{ $vehicle->type }}</td>
                            <td>{{ $vehicle->stock }}</td>
                            <td>{{ $vehicle->charter_price }}</td>
                            <td>{{ $vehicle->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-end mt-3"> <!-- Atur posisi sesuai kebutuhan -->
                <a class="text-bg-info text-decoration-none" href="/vehicle">
                    <h5>Selengkapnya</h5>
                </a>
            </div>
        </div>
    </section>

@endsection
