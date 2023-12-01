@extends('template.templateAdmin')
@section('vehicle', 'active')

@section('main')

    <section class="row gap-4 me-2">

        {{-- Section header Body --}}
        <section class="card row shadow" style="background-color: #F5F5F5;">
            <div class="col-12 head-card mb-1 mt-1">
                <h2>Detail Kendaraan</h2>
                <p><a href="/" class="text-black text-decoration-none">Home</a> > <a href="/vehicle"
                        class="text-decoration-none text-black">Manage Kendaraan</a> > <a href=""
                        class="text-decoration-none">Detail Kendaraan</a>
                </p>
            </div>

            <section class="slider_container mt-1 d-flex justify-content-center">
                <div class="container shadow-sm mb-3 ">
                    <div class="swiper card_slider ">
                        <div class="swiper-wrapper">

                            @foreach ($vehicles as $vehicle)
                                <div class="swiper-slide">
                                    <form action="{{ route('admindetailvehicle', ['vehicle_id' => $vehicle->vehicle_id]) }}"
                                        method="get" class="d-flex  justify-content-center m-2">
                                        @csrf
                                        <button type="submit" class="border-0 text-decoration-none p-0 rounded">
                                            <div class="card" style="height: 100%; width:100%;">
                                                <div class="card">
                                                    <img src="{{ $vehicle->vehicle_photo }}" alt="" height="200px"
                                                        class=" rounded">
                                                </div>
                                                <div class="">
                                                    <h5 class="text-center">{{ $vehicle->name }}</h5>
                                                    <p class="text-center">{{ $vehicle->charter_price }}</p>
                                                    <p class="text-gray text-end me-1">stock: {{ $vehicle->stock }}</p>
                                                </div>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

            </section>

        </section>
        {{-- Section Detail --}}
        <section class="card row p-3" style="background-color: #F5F5F5;">
            <div class="row d-flex flex-row flex-wrap m-3">
                <div class="col-4 offset-1">
                    <img src="{{ $vehicleold->vehicle_photo }}" alt="" class=" rounded m-2"
                        style="height: 300px; width:400px;">
                </div>
                <div class="col-4 offset-2">
                    <h6>Deskripsi</h6>
                    <div class=" card overflow-auto p-2" style="height: 200px;">
                        <p class="text-start m-3">
                            {{ $vehicleold->description }}
                        </p>
                    </div>
                </div>
                <div class="col-4 offset-1 d-flex flex-column mt-3">
                    <label for="name">Nama Kendaraan</label>
                    <input class="card" type="text" name="name" id="name" value="{{ $vehicleold->name }}" readonly>
                </div>
                <div class="col-4 offset-2 d-flex flex-column mt-3">
                    <label for="type">Jenis</label>
                    <input class="card" type="text" name="type" id="type" value="{{ $vehicleold->type }}" readonly>
                </div>
                <div class="col-4 offset-1 d-flex flex-column mt-3">
                    <label for="stock">Stok</label>
                    <input class="number" type="text" name="stock" id="stock" value="{{ $vehicleold->stock }} Unit" readonly>
                </div>
                <div class="col-4 offset-2 d-flex flex-column mt-3">
                    <label for="charter_price">Harga Sewa</label>
                    <input class="card" type="text" name="charter_price" id="charter_price" value="Rp.{{ number_format($vehicleold->charter_price, 0, ',', '.') }}/Hari" readonly>
                </div>
                <div class="col-4 offset-1 d-flex flex-column mt-3">
                    <label for="status">Status</label>
                    <input class="card" type="text" name="status" id="status" value="{{ $vehicleold->status }}" readonly>
                </div>
            </div>

            <form class="row" action="{{ route('viewadminupdatevehicle', ['vehicle_id' => $vehicleold->vehicle_id]) }}"
                method="GET">

                <div class="mb-3">
                    <button class="btn btn-primary" type="submit"> <i class="fa-solid fa-right-to-bracket"></i> Kehalaman
                        Update</button>
                </div>
            </form>
        </section>


    </section>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".card_slider", {
            slidesPerView: '4',
            direction: 'horizontal',
            loop: false,
            allowTouchMove: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },


        });
    </script>
@endsection
