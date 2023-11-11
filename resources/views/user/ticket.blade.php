@extends('template.templateUser')
@section('main')
<header>
    <div class="col-4 offset-1">

        <p><a class=" text-decoration-none text-black " href="/bookings"> Bookings</a> ><a href="/ticket{{ $booking['booking_id'] }}}}" class=" text-decoration-none text-base ">Ticket</a></p>
    </div>
</header>
    @foreach ($ticket as $tickets)
        <div class="container">
            <div class="row card d-flex flex-row mt-5 align-items-end">
                <header class=" row justify-content-end">
                    <form action="{{ route('downloadTicket') }}" method="post" class="col-2 offset-1 mb-3">
                        @csrf
                        <input type="hidden" name="detail_booking_id" value="{{ $tickets->detail_booking_id }}">
                        <button class="mt-3 text-bg-primary" type="submit">Download</button>
                    </form>
                </header>
                <div class="col-4  d-flex flex-column">
                    <header>
                        <h5 class="text-center">ID Ticket : {{ $tickets->detail_booking_id }}</h5>
                    </header>

                    <body>
                        <img src="{{ $tickets->vehicle->vehicle_photo }}" alt="kendaraan" height="50%" width="100%"
                            srcset="">
                    </body>
                    <footer class="d-flex justify-content-start align-items-center">
                        <div class="card bg-primary-subtle mt-3 " style="width: 50%;">
                            <p class="text-center m-1">{{ $tickets->status }}</p>
                        </div>
                    </footer>
                </div>
                <div class="col-6 mb-5">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Nama Pemesan</th>
                                <td>{{ Auth::user()->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Nama Kendaraan</th>
                                <td>RX King Terkencang</td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah Kendaraan</th>
                                <td>{{ $tickets->qty }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tanggal Pengambilan</th>
                                <td>{{ $tickets->pickup_date }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tanggal Pengembalian</th>
                                <td>{{ $tickets->return_date }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Harga Sewa / Hari</th>
                                <td>Rp. {{ $tickets->vehicle->charter_price }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah Hari</th>
                                <td>{{ $tickets->day }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Alamat Toko</th>
                                <td>{{ $admin->address }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Harga Sewa Total</th>
                                <td>Rp. {{ $tickets->price_total_charter }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <form action="{{ route('deleteticket') }}" method="post" class="col-1 offset-1 mb-3">
                    @csrf
                    <input type="hidden" name="detail_booking_id" value="{{ $tickets->detail_booking_id }}">
                    <input type="hidden" name="booking_id" value="{{ $booking['booking_id'] }}">
                    <button  type="submit">Hapus</button>
                </form>
            </div>
        </div>
    @endforeach
@endsection
