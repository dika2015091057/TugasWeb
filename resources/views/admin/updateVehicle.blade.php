@extends('template.templateAdmin')
@section('vehicle', 'active')

@section('main')
    <section class="row gap-4 me-2">

        {{-- Section header Body --}}
        <section class="card row shadow" style="background-color: #F5F5F5;">
            <div class="col-12 head-card mb-1 mt-1">
                <h2>Update Kendaraan</h2>
                <p><a href="/" class="text-black text-decoration-none">Home</a> > <a href="/vehicle"
                        class="text-decoration-none text-black">Manage Kendaraan</a> > <a href=""
                        class="text-decoration-none">Update Kendaraan</a>
                </p>
            </div>
            <section class="slider_container mt-1 d-flex justify-content-center">
                <div class="container shadow-sm m-3">
                    <div class="swiper card_slider">
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
        {{-- Section create --}}
        <section class="card row p-3" style="background-color: #F5F5F5;">
            <form class="was-validated" action="{{ route('adminupdatevehicle') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="vehicle_id" value="{{ $vehicleold->vehicle_id }}">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" placeholder="nama kendaraan anda"
                        name="name" value="{{ $vehicleold->name }}" required>
                    <label for="name">Nama Kendaraan</label>
                </div>

                <div class="form-floating mb-3">
                    <select class="form-select" required aria-label="Jenis Kendaraan" name="type">
                        <option value="{{ $vehicleold->type }}">{{ $vehicleold->type }}</option>
                        <option value="Mobil">Mobil</option>
                        <option value="Motor">Motor</option>
                        <option value="Sepeda">Sepeda</option>
                    </select>
                    <div class="invalid-feedback p-1">silakan pilih</div>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="stock" placeholder="jumlah stok kendaraan"
                        name="stock" value="{{ $vehicleold->stock }}" Required>
                    <label for="stock">Stok kendaraan anda</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="charter_price" placeholder="Harga Sewa Harian"
                        name="charter_price" value="{{ $vehicleold->charter_price }}" Required>
                    <label for="charter_price">Harga Sewa Harian</label>
                </div>

                <div class="form-floating mb-3">
                    <select class="form-select" required aria-label="Jenis Kendaraan" name="status">
                        <option value="{{ $vehicleold->status }}">{{ $vehicleold->status }}</option>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Kosong">Kosong</option>
                    </select>
                    <div class="invalid-feedback p-1">silakan pilih</div>
                </div>

                <div class="mb-3">
                    <label for="validationTextarea" class="form-label p-1">deskripsi</label>
                    <textarea class="form-control" id="" placeholder="deskripsi kendaraan anda" rows="3" name="description"
                        required>{{ $vehicleold->description }}</textarea>
                    <div class="invalid-feedback p-1">
                        tolong masukkan deskripsi
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" placeholder="masukkan password"
                        name="password" Required>
                    <label for="password">Password Validasi</label>
                </div>

                <div class="mb-3">
                    <input type="file" name="photo" accept="image/jpeg, image/png" class="form-control">
                </div>

                <div class="mb-3">
                    <button class="btn btn-primary" type="submit"><i class="fa-solid fa-circle-up"></i> Update
                        Kendaraan</button>
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
