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
            <form class=" w-50  me-3 bg-transparent " role="search" method="GET">
                <input type="search" class="form-control bg-transparent  rounded-pill py-3 shadow " placeholder="Search nama kendaraan anda"
                    aria-label="Search" name="search" id="search" value="{{ $search }}">
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
                        <th scope="col">@sortablelink('name', 'Nama Kendaraan')</th>
                        <th scope="col">@sortablelink('type', 'Tipe')</th>
                        <th scope="col">@sortablelink('stock', 'Stok')</th>
                        <th scope="col">@sortablelink('charter_price', 'Harga Sewa')</th>
                        <th scope="col">@sortablelink('status', 'Status')</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $rowNumber = 1 + ($vehicles->currentPage() - 1) * $vehicles->perpage(); // Inisialisasi nomor baris
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
                                    <form action="{{ route('admindetailvehicle',['vehicle_id' => $vehicle->vehicle_id]) }}" method="GET">   
                                        <button type="submit" class="btn btn-info">
                                            <i class="fa-solid fa-pen-to-square fa-bounce"></i>
                                            Detail</button>
                                    </form>
                                    <form action="{{ route('viewadminupdatevehicle',['vehicle_id' => $vehicle->vehicle_id]) }}" method="GET">
                                        <button type="submit" class="btn btn-info">
                                            <i class="fa-solid fa-pen-nib fa-bounce"></i>
                                            Update</button>
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
            {{-- {{ $vehicles->links('pagination::bootstrap-5') }} --}}
            {!! $vehicles->appends(Request::except('page'))->render('pagination::bootstrap-5') !!}
        </div>
    </section>

@endsection
