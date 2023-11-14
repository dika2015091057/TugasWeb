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
            <div class="d-flex align-items-center justify-content-start">
                <form class=" w-50  me-3 bg-transparent " role="search" action="{{ route('search') }}">
                    <input type="search" class="form-control bg-transparent  rounded-pill py-3 shadow " placeholder="Search..."
                        aria-label="Search" name="search">
                </form>

                <form action="">
                    <select id="sortingSelect" class="form-select form-select-lg" aria-label="Large select example">
                        <option value="name">Nama</option>
                        <option value="total">Total</option>
                        <option value="status">Status</option>
                    </select>
                </form>

                <form id="orderSelect">
                    <select id="orderOption" class="form-select form-select-lg" aria-label="Large select example">
                        <option value="asc">Naik</option>
                        <option value="desc">Turun</option>
                    </select>
                </form>

            </div>

            <div class="card row d-flex shadow  px-0 pb-5" style="background-color: #F5F5F5; ">
                <div class="card-header bg-primary text-bg-primary">
                    <h2> Detail Booking | {{ $id }}</h2>
                </div>
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Pemesan</th>
                            <th scope="col">Nama Kendaraan</th>
                            <th scope="col">Sewa</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Pengambilan</th>
                            <th scope="col">Pengembalian</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th class="text-center" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @php
                            $rowNumber = 1; // Inisialisasi nomor baris
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
                                                    <input type="hidden" name="status" value="Batal">
                                                    <input type="hidden" name="booking_id" value="{{ $id }}">
                                                    <input type="hidden" name="detail_booking_id" value="{{ $detail->detail_booking_id }}">
                                                    <button class="dropdown-item btn btn-primary" type="submit">Batal</button>
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
                {{ $details->appends(['booking_id' => $id])->links('pagination::bootstrap-5') }}
            </div>
        </section>

        <script>
            let orderDirection = 'asc'; // Inisialisasi urutan naik
            let tableBody = document.querySelector('tbody'); // Memindahkan ini ke luar fungsi

            // Inisialisasi rows di luar fungsi
            let rows = Array.from(tableBody.querySelectorAll('tr'));

            // Fungsi sortRows() yang memanipulasi rows
            function sortRows() {
                const selectedValue = document.getElementById('sortingSelect').value;
                let comparator;

                if (selectedValue === 'name') {
                    comparator = (a, b) => a.cells[1].textContent.localeCompare(b.cells[1].textContent);
                } else if (selectedValue === 'total') {
                    comparator = (a, b) => parseFloat(a.cells[2].textContent) - parseFloat(b.cells[2].textContent);
                } else if (selectedValue === 'status') {
                    comparator = (a, b) => a.cells[3].textContent.localeCompare(b.cells[3].textContent);
                }

                // Lakukan pengurutan berdasarkan comparator dan arah urutan
                rows.sort((a, b) => {
                    const comparisonResult = comparator(a, b);
                    return orderDirection === 'asc' ? comparisonResult : -comparisonResult;
                });

                // Hapus baris yang ada dari tabel
                tableBody.innerHTML = '';

                // Tambahkan baris yang sudah diurutkan ke tabel
                rows.forEach(row => tableBody.appendChild(row));
            }

            // Tambahkan event listener untuk select pertama
            document.getElementById('sortingSelect').addEventListener('change', function() {
                sortRows();
            });

            // Event listener untuk select kedua
            document.getElementById('orderOption').addEventListener('change', function() {
                orderDirection = this.value;
                sortRows();
            });
        </script>

    @endsection
