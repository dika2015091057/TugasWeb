@extends('template.templateUser')
@section('main')
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

        <div class="card offset-3 " style="height: 85%;">
            <div class="header m-2">
                <h3>Atur Jumlah Kendaraan</h3>
            </div>
            <form action="{{ route('createBooking') }}" method="POST">
                @csrf
                <input type="hidden" name="vehicle_id" value="{{ $vehicle->vehicle_id }}">
                <div class="row d-flex mt-3 ">
                    <div class="card col-4 offset-1 d-flex flex-row gap-3 py-1 shadow">
                        <button type="button"
                            class="border border-0 bg-transparent col-1 d-flex justify-content-center align-items-center"
                            onclick="changeValue('plus'),updateTotal('plus')">+</button>
                        <input type="number" name="qty" class="d-flex wrap border border-0 col-4 text-center "
                            id="qty" value="1">
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
                    <label class="col-4 offset-1 ps-0 py-2" for="pengambilan">Pengambilan:</label>
                    <input class="col-5 border border-light-subtle rounded-3" type="date" id="pengambilan"
                        name="pengambilan">
                </div>
                <div class="row d-flex mt-2 ">
                    <label class="col-4 offset-1 ps-0 py-2" for="pengembalian">Pengembalian:</label>
                    <input class="col-5 border border-light-subtle rounded-3" type="date" id="pengembalian"
                        name="pengembalian">
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
                    <button class="btn btn-primary d-flex justify-content-start">booking</button>
                </div>
            </form>
        </div>

    </div>
    </div>

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

        function updateTotal() {
            var qty = parseFloat(document.getElementById("qty").value);
            var price = parseFloat(document.getElementById("price").value);

            if (!isNaN(qty) && !isNaN(price)) {
                var total = qty * price;
                document.getElementById("total").value = total;
            } else {
                document.getElementById("total").value = "0";
            }
        }

        // Panggil updateTotal() saat qty atau price berubah
        document.getElementById("qty").addEventListener("change", updateTotal);
        document.getElementById("price").addEventListener("change", updateTotal);

        // Panggil updateTotal() untuk menginisialisasi total awal
        updateTotal();
    </script>
@endsection
