@extends('template.templateUser')
@section('main')
    <header>
        <div class="col-3 offset-2">

            <a href="/bookings" class=" text-decoration-none text-base ">Booking</a>
        </div>
    </header>
    <div class="container">
        <h1 class="text-center">Daftar Booking</h1>
        @foreach ($booking as $bookings)
            <div class="container">
                <div class="row card d-flex flex-row mt-5 align-items-end justify-content-between">
                    <header class=" row justify-content-end">
                        <a href="/ticket{{ $bookings['booking_id'] }}}}"  class="col-2 offset-1 mb-3">
                            @csrf
                            <input type="hidden" name="booking_id" value="{{ $bookings->booking_id }}">
                            <button class="mt-3 text-bg-primary" type="submit">Lihat Detail</button>
                        </a>
                    </header>
                    <div class="col-4  d-flex flex-column ps-0  me-2">

                        <body>
                            <img src="{{ $bookings->admin_photo }}" alt="Foto Toko" height="300px" width="350px" class=" rounded-end-4"
                                srcset="">
                        </body>
                    </div>
                    <div class="col-6 mb-5">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">ID Booking</th>
                                    <td>{{ $bookings->booking_id }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nama Toko</th>
                                    <td>{{ $bookings->admin_name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Status Booking</th>
                                    <td>{{ $bookings->status }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Alamat Toko</th>
                                    <td>{{ $bookings->admin_address }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Harga Total Booking</th>
                                    <td>{{ $bookings->price_total_booking }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <form action="{{ route('deletebooking') }}" method="post" class="col-1 mb-3">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $bookings->booking_id }}">
                        <button type="submit">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endsection
