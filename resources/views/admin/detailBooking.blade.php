    @extends('template.templateAdmin')
    @section('booking', 'active')

    @section('main')
        <section class="row gap-4 me-2">

            {{-- Section header Body --}}
            <div class="card row shadow" style="background-color: #F5F5F5;">
                <div class="col-12 head-card mb-3 mt-1">
                    <h2>Detail Booking</h2>
                    <p><a href="/" class="text-black text-decoration-none">Home</a> > <a href="/booking"
                            class="text-decoration-none text-black">Manage Booking</a> > <a href="" class="text-decoration-none">Detail booking</a>
                    </p>
                </div>
            
            </div>

            {{-- Section Search --}}
          

            <div class="card row d-flex shadow  px-0 pb-5" style="background-color: #F5F5F5; ">
                <div class="card-header bg-primary text-bg-primary">
                    <h2> Detail Booking | {{ $id }}</h2>
                </div>
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Pemesan</th>
                            <th scope="col">@sortablelink('vehicle.name', 'Nama Kendaraan')</th>
                            <th scope="col">@sortablelink('vehicle.charter_price', 'Sewa')</th>
                            <th scope="col">@sortablelink('qty', 'Qty')</th>
                            <th scope="col">@sortablelink('pickup_date', 'Pengambilan')</th>
                            <th scope="col">@sortablelink('return_date', 'Pengembalian')</th>
                            <th scope="col">@sortablelink('day', 'Waktu')</th>
                            <th scope="col">@sortablelink('price_total_charter', 'Total')</th>
                            <th scope="col">@sortablelink('status', 'Status')</th>
                            <th class="text-center" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @php
                            $rowNumber = 1 + ($details->currentPage() - 1) * $details->perpage(); // Inisialisasi nomor baris
                        @endphp
                        @foreach ($details as $detail)
                            <tr class="">
                                <th scope="row">{{ $rowNumber++ }}</th>
                                <td >{{ $detail->booking->user->name }}</td>
                                <td>{{ $detail->vehicle->name }}</td>
                                <td >{{ number_format($detail->vehicle->charter_price,'0',',','.') }}/Hari</td>
                                <td >{{ $detail->qty }} unit</td>
                                <td >{{ $detail->pickup_date }}</td>
                                <td >{{ $detail->return_date }}</td>
                                <td >{{ $detail->day }} Hari</td>
                                <td >Rp.{{ number_format($detail->price_total_charter,'0',',','.') }}</td>
                                <td >{{ $detail->status }}</td>
                                <td >
                                    <div class="container d-flex flex-row gap-2 justify-content-center">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-pen-to-square fa-bounce"></i>Update
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <form action="{{ route('updatedetailstatus') }}" method="POST" class="d-flex">
                                                    @csrf
                                                    <input type="hidden" name="status" value="Lunas">
                                                    <input type="hidden" name="detail_booking_id" value="{{ $detail->detail_booking_id }}">
                                                    <input type="hidden" name="booking_id" value="{{ $id }}">
                                                    <button class="dropdown-item" type="submit">Lunas</button>
                                                </form>
                                                <li><hr class="dropdown-divider"></li>
                                                <form action="{{ route('updatedetailstatus') }}" method="POST" class="d-flex">
                                                    @csrf
                                                    <input type="hidden" name="status" value="belum dibayar">
                                                    <input type="hidden" name="booking_id" value="{{ $id }}">
                                                    <input type="hidden" name="detail_booking_id" value="{{ $detail->detail_booking_id }}">
                                                    <button class="dropdown-item btn btn-primary" type="submit">Belum Dibayar</button>
                                                </form>
                                            </ul>
                                        </div>
                                        <form action="deletedetailbooking" method="POST">
                                            @csrf
                                            <input type="hidden" name="booking_id" value="{{ $id }}">
                                            <input type="hidden" name="detail_booking_id" value="{{ $detail->detail_booking_id }}">
                                            <button type="submit" class="btn btn-danger"><i class="fa-sharp fa-solid fa-trash-can "></i>
                                                Delete</button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $details->appends(['booking_id' => $id])->links('pagination::bootstrap-5') }} --}}
                {!! $details->appends(Request::except('page'))->render('pagination::bootstrap-5') !!}
            </div>
        </section>

    @endsection
