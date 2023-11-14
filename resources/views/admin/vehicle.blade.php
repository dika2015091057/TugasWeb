@extends('template.templateAdmin')
@section('vehicle', 'active')

@section('main')
    <section class="row gap-4 me-2">

        {{-- Section header Body --}}
        <div class="card row shadow" style="background-color: #F5F5F5;">
            <div class="col-12 head-card mb-3 mt-1">
                <h2>Manage Kendaraan</h2>
                <p><a href="/" class="text-black text-decoration-none">Home</a> > <a href="/vehicle"
                        class="text-decoration-none text-gray-900">Manage Kendaraan</a></p>
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

        {{-- Section Search --}}
        <div class="d-flex align-items-center justify-content-start">
            <form class=" w-50  me-3 bg-transparent " role="search" action="{{ route('search') }}">
                <input type="search" class="form-control bg-transparent  rounded-pill py-3 shadow " placeholder="Search..."
                    aria-label="Search" name="search">
            </form>

            <form action="">
                <select id="sortingSelect" class="form-select form-select-lg" aria-label="Large select example">
                    <option value="name">Nama Kendaraan</option>
                    <option value="type">Tipe</option>
                    <option value="stock">stok</option>
                    <option value="charter">Harga sewa</option>
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
            <div class="card-header bg-primary text-bg-primary d-flex justify-content-between">
                <h2> Kendaraan</h2>
                <form action="{{ route('createvehicle') }}" method="GET">
                    @csrf
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-add"></i> Tambahkan
                    </button>
                </form>
            </div>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Kendaraan</th>
                        <th scope="col">Tipe</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Harga Sewa</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
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
                            <td>{{ $vehicle->stock }} Unit</td>
                            <td>{{  number_format($vehicle->charter_price, 0, ',', '.') }}/Hari</td>
                            <td>{{ $vehicle->status }}</td>
                            <td>
                                <div class="container d-flex flex-row gap-2 justify-content-center">
                                    <form action="" method="GET">
                                        @csrf
                                        <input type="hidden" name="booking_id" value="{{ $vehicle->vehicle_id }}">
                                        <button type="submit" class="btn btn-info">
                                            <i class="fa-solid fa-pen-to-square fa-bounce"></i>
                                            Detail</button>
                                    </form>
                                    <form action="{{ route('deletevehicle') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="vehicle_id" value="{{ $vehicle->vehicle_id }}">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa-sharp fa-solid fa-trash-can "></i>
                                            Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $vehicles->links('pagination::bootstrap-5') }}
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
    } else if (selectedValue === 'type') {
        comparator = (a, b) => a.cells[2].textContent.localeCompare(b.cells[2].textContent);
    } else if (selectedValue === 'stock') {
        comparator = (a, b) => parseInt(a.cells[3].textContent) - parseInt(b.cells[3].textContent);
    } else if (selectedValue === 'charter') {
        comparator = (a, b) => parseFloat(a.cells[4].textContent) - parseFloat(b.cells[4].textContent);
    } else if (selectedValue === 'status') {
        comparator = (a, b) => a.cells[5].textContent.localeCompare(b.cells[5].textContent);
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
