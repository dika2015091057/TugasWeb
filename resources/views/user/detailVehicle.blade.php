@extends('template.templateUser')
@section('title', 'Detail | ')
@section('main')
    <header>
        <div class="col-4 offset-1">

            <p class="mt-3"><a class=" text-decoration-none text-black " href="/"> Dashboard</a> ><a
                    href="/detail{{ $vehicle['vehicle_id'] }}" class=" text-decoration-none text-base ">Detail</a></p>
        </div>
    </header>
    <div class="container-card  d-flex flex-wrap gap-2 justify-content-start offset-1 mt-5" style="height: 500px;">
        <div class="card d-flex flex-row flex-wrap gap-2 col-6 px-1 py-1" style="height: 100%;">
            <div class="col-5 image-container d-flex" style="height: 80%;">
                <div class="">
                    <img src="{{ $vehicle['vehicle_photo'] }}" alt="Vehicle" class="img-fluid rounded ">
                </div>
            </div>
            <div class="card col d-flex flex-column gap-2 border-0">
                <div class="card ps-1">
                    <p><span style="font-weight: bold;">Nama Kendaraan:</span> {{ $vehicle->name }}</p>
                    <p><span style="font-weight: bold;">Harga Sewa :</span> Rp. {{ $vehicle->charter_price }}</p>
                    <input type="hidden" name="price" id="price" value="{{ $vehicle->charter_price }}">
                </div>
                <div class="card ps-1">
                    <header>
                        <h4 class="text-center">Detail Kendaraan</h4>
                    </header>
                    <div class="body" style="height: 250px; ">
                        <p><span style="font-weight: bold;">Nama Kendaraan:</span> {{ $vehicle->name }}</p>
                        <p><span style="font-weight: bold;">Tipe :</span> {{ $vehicle->type }}</p>
                        <p><span style="font-weight: bold;">Deskripsi :</span> {{ $vehicle->description }}</p>

                    </div>
                </div>
                <div class="card col-8 offset-2 d-flex flex-row align-items-center gap-2 ps-1" style="height: 95px;">
                    <img class=" rounded-circle" width="60px" height="60px" src="{{ $vehicle->admin->photo_profile }}">
                    <p class=" m-0" style="font-weight: bold;"> {{ $vehicle->admin->username }}</p>
                </div>
            </div>


        </div>

        <div class="card offset-3 " style="height: 100%;">
            <div class="header m-2">
                <h3>Atur Jumlah Kendaraan</h3>
            </div>
            <form action="{{ route('createBooking') }}" method="POST">
                @csrf
                <input type="hidden" name="vehicle_id" value="{{ $vehicle->vehicle_id }}">
                <div class="row d-flex mt-3 ">
                    <div class="card col-5 offset-1 d-flex flex-row gap-2 py-1 shadow justify-content-between">
                        <button type="button"
                            class="border border-0 bg-transparent col-1 d-flex justify-content-center align-items-center"
                            onclick="changeValue('plus'),updateTotal('plus')">+</button>
                        <input type="number" name="qty" class="d-flex wrap border border-0 col-4 text-center "
                            id="qty" value="1" readonly>
                        <button type="button"
                            class="border border-0 bg-transparent col-1 d-flex justify-content-center align-items-center"
                            onclick="changeValue('minus'),updateTotal('minus')">-</button>
                    </div>
                    <div class="stock col-4 offset-2 d-flex justify-content-center py-1">
                        <p class="mb-0 text-center" id="stock" data-value="{{ $vehicle['stock'] }}"> Stok:
                            {{ $vehicle['stock'] }}</p>
                    </div>
                </div>
                <div class="row d-flex mt-5">
                    <label class="col-5 offset-1 ps-0 py-2" for="pengambilan">Pengambilan:</label>
                    <input class="col-5 px-2 me-1 border border-light-subtle rounded-3" type="date" id="pengambilan"
                        name="pengambilan" onclick="sewa()">
                </div>
                <div class="row d-flex mt-2  ">
                    <label class="col-5 offset-1 ps-0 py-2" for="pengembalian">Pengembalian:</label>
                    <input class="col-5 px-1 me-1 border border-light-subtle rounded-3 justify-content-end" type="date"
                        id="pengembalian" name="pengembalian" onclick="sewa()">
                </div>
                <div class="row d-flex mt-2 justify-content-start ms-1 gap-3 ">
                    <p class="col-4">Hari Sewa</p>
                    <div class="col-5">
                        <label for="total" class="col-2 text-end"></label>
                        <input class=" col-9 border-0 " type="number" name="day" id="harisewa" value="0"
                            readonly>
                    </div>
                </div>
                <div class="row d-flex mt-5 justify-content-center gap-3 ">
                    <p class="col-4">Sub Total</p>
                    <div class="col-5">
                        <label for="total" class="col-2 text-end">Rp </label>
                        <input class=" col-9 border-0 " type="number" name="total" id="total"
                            value="{{ $vehicle['charter_price'] }}" readonly>
                    </div>
                </div>
                <div class="col-4 offset-4 d-flex mt-5 justify-content-center gap-3">
                    <button class="btn btn-primary d-flex justify-content-start" id="bookingButton"
                        onclick="booking()">booking</button>
                </div>
            </form>
        </div>

    </div>
    </div>

    <section class="slider_container mt-5">
        <div class="container border">
            <div class="swiper card_slider">
                <div class="swiper-wrapper">
                    @foreach ($adminVehicles as $vehicles)
                        <div class="swiper-slide">
                            <form action="{{ route('detail', ['id' => $vehicles->vehicle_id]) }}" method="get" class="d-flex m-2">
                                @csrf
                                <button type="submit" class="border-0">
                                    <div class="card d-grid" style="height: 100%; width:100%;">
                                        <div class="card">
                                            <img src="{{ $vehicles->vehicle_photo }}" alt="" height="200px">
                                        </div>
                                        <div class="border ">
                                            <h5 class="text-center">{{ $vehicles->name }}</h5>
                                            <p class="text-center">{{ $vehicle->charter_price }}</p>
                                            <p class="text-gray text-end me-1">stock: {{ $vehicles->stock }}</p>
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

    <script>
        function changeValue(operation) {
            var qtyInput = document.getElementById("qty");
            var currentValue = parseInt(qtyInput.value);
            var stock = parseInt(document.getElementById('stock').getAttribute('data-value'));

            if (operation === 'plus' && currentValue < stock) {
                qtyInput.value = currentValue + 1;
            } else if (operation === 'minus' && currentValue > 1) {
                qtyInput.value = currentValue - 1;
            }
        }

        function sewa() {
            var datePengambilan = document.getElementById("pengambilan").value;
            var datePengembalian = document.getElementById("pengembalian").value;

            // Jika tanggal pengambilan atau pengembalian kosong, set harisewa menjadi 0
            if (datePengambilan === '' || datePengembalian === '') {
                document.getElementById("harisewa").value = 0;
            } else {
                var datetimePengambilan = new Date(datePengambilan);
                var datetimePengembalian = new Date(datePengembalian);

                var timeDiff = datetimePengembalian.getTime() - datetimePengambilan.getTime();
                var duration = Math.ceil(timeDiff / (1000 * 3600 * 24));

                document.getElementById("harisewa").value = duration;
            }
            updateTotal();
        }

        function updateTotal() {
            var qty = parseFloat(document.getElementById("qty").value);
            var price = parseFloat(document.getElementById("price").value);
            var hari = parseFloat(document.getElementById("harisewa").value);


            if (!isNaN(qty) && !isNaN(price)) {
                var total = qty * price * hari;
                document.getElementById("total").value = total;
            } else {
                document.getElementById("total").value = "0";
            }

            booking();
        }

        function booking() {
            var stock = parseInt(document.getElementById('stock').getAttribute('data-value'));
            var bookingButton = document.getElementById("bookingButton");
            var total = parseFloat(document.getElementById("total").value);
            if (stock <= 0 || total <= 0) {
                bookingButton.disabled = true; // Jika stok 0, tombol akan dinonaktifkan
            } else {
                bookingButton.disabled = false; // Jika ada stok, tombol tetap aktif
            }
        }

        // Panggil updateTotal() saat qty atau price berubah
        document.getElementById("qty").addEventListener("change", updateTotal);
        document.getElementById("price").addEventListener("change", updateTotal);

        // Panggil updateTotal() untuk menginisialisasi total awal

        updateTotal();

        // Panggil fungsi Sewa() setiap kali tanggal diubah
        document.getElementById("pengambilan").addEventListener("change", sewa);
        document.getElementById("pengembalian").addEventListener("change", sewa);

        // Panggil updateTotal() untuk menginisialisasi total awal
        updateTotal();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".card_slider", {
            slidesPerView: '4', // Jumlah slide yang ditampilkan
            spaceBetween: 30, // Spasi antar slide
            direction: 'horizontal', // Atur arah swiper menjadi horizontal
            loop: false, // Untuk membuat efek loop
            allowTouchMove: true,
            pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
            


        });
    </script>
@endsection
