@extends('template.templateAdmin')
@section('booking', 'active')

@section('main')
    <section class="row gap-4 me-2">

        {{-- Section header Body --}}
        <div class="card row shadow" style="background-color: #F5F5F5;">
            <div class="col-12 head-card mb-3 mt-1">
                <h2>Manage Booking</h2>
                <p><a href="/" class="text-black text-decoration-none">Home</a> > <a href="/booking"
                        class="text-decoration-none text-gray-900">Manage Booking</a></p>
            </div>
            <div class="container d-flex flex-wrap justify-content-between gap-3" style="height: 200px">
                <div class="card mb-3 flex-grow-1 borde-0 shadow">
                    <!-- Menggunakan flex-grow untuk memungkinkan penyesuaian otomatis -->
                    <header class="card-header ">Stok Kendaraan</header>
                    <div class="card-body">
                        <p class="card-text">{{ $sum }}</p>
                    </div>
                </div>
                <div class="card mb-3 flex-grow-1 borde-0 shadow">
                    <!-- Menggunakan flex-grow untuk memungkinkan penyesuaian otomatis -->
                    <header class="card-header ">Stok Kendaraan</header>
                    <div class="card-body">
                        <p class="card-text">{{ $sum }}</p>
                    </div>
                </div>
                <div class="card mb-3 flex-grow-1 borde-0 shadow">
                    <!-- Menggunakan flex-grow untuk memungkinkan penyesuaian otomatis -->
                    <header class="card-header ">Stok Kendaraan</header>
                    <div class="card-body">
                        <p class="card-text">{{ $sum }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section Search --}}
        <div class="d-flex align-items-center justify-content-start">
            <form class=" w-50  me-3 bg-transparent " role="search" method="GET">
                <input type="search" class="form-control bg-transparent  rounded-pill py-3 shadow " placeholder="Search..."
                    aria-label="Search" name="search" id="search" autofocus="true" value="{{ $search }}">
            </form>



        </div>

        <div class="card row d-flex shadow  px-0 pb-5" style="background-color: #F5F5F5; ">
            <div class="card-header bg-primary text-bg-primary">
                <h2> Booking</h2>
            </div>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">@sortablelink('user.name', 'Nama Pemesan')</th>
                        <th scope="col">@sortablelink('price_total_booking', 'Total Harga Booking')</th>
                        <th scope="col">@sortablelink('status', 'Status')</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $rowNumber = 1 + ($bookings->currentPage() - 1) * $bookings->perpage(); // Inisialisasi nomor baris
                    @endphp
                    @foreach ($bookings as $booking)
                        <tr>
                            <th scope="row">{{ $rowNumber++ }}</th>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ number_format($booking->price_total_booking, '0', ',', '.') }}</td>
                            <td>{{ $booking->status }}</td>
                            <td class="text-center ">
                                <div class="container d-flex flex-row gap-2 justify-content-center">
                                    <form action="{{ route('viewDetailBooking', ['booking_id' => $booking->booking_id]) }}"
                                        method="GET">
                                        @csrf
                                        <input type="hidden" name="booking_id" value="{{ $booking->booking_id }}">
                                        <button type="submit" class="btn btn-info">
                                            <i class="fa-solid fa-pen-to-square fa-bounce"></i>
                                            Detail
                                        </button>
                                    </form>
                                    <form action="admindeletebooking" method="POST">
                                        @csrf
                                        <input type="hidden" name="booking_id" value="{{ $booking->booking_id }}">
                                        <button type="submit" class="btn btn-danger"><i
                                                class="fa-sharp fa-solid fa-trash-can "></i>
                                            Delete</button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{ $bookings->links('pagination::bootstrap-5') }} --}}
            {!! $bookings->appends(Request::except('page'))->render('pagination::bootstrap-5') !!}
        </div>
    </section>



@endsection
