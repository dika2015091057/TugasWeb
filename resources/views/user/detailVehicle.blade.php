@extends('template.templateUser')
@section('main')
    {{-- <div class="container d-flex flex-column gap-5 offset-3 col-3"> --}}
    {{-- <div class="container d-flex flex-column gap-5"> --}}
    <div class="container-card d-flex flex-wrap gap-2 justify-content-start offset-1 mt-5">
        <div class="card d-flex flex-column gap-2 col-3 px-1 py-1">
            <div class="image-container d-flex">
                <img src="{{ $vehicle['vehicle_photo'] }}" alt="Vehicle" class="img-fluid rounded ">
            </div>
        </div>
        <div class="footer">
            <p><span style="font-weight: bold;">Nama :</span> {{ $vehicle->name }}</p>
            <p><span style="font-weight: bold;">Nama :</span> {{ $vehicle->admin->username }}</p>
            <input  class=" col-5 border-0 " type="number" name="price" id="price" value="{{ $vehicle->charter_price }}">


        </div>

        <div class="card offset-4 ">
            <div class="header m-2">
                <h3>Atur Jumlah Kendaraan</h3>
            </div>
            <form action="{{ route('createBooking') }}" method="POST">
                @csrf
                <input type="hidden" name="vehicle_id" value="{{ $vehicle->vehicle_id }}">
                <div class="row d-flex mt-3 ">
                    <div class="card col-4 offset-1 d-flex flex-row gap-3 py-1 shadow">
                        <button type="button" class="border border-0 bg-transparent col-1 d-flex justify-content-center align-items-center" onclick="changeValue('plus'),updateTotal('plus')">+</button>
                        <input type="number" name="qty" class="d-flex wrap border border-0 col-4 text-center " id="qty" value="1">
                        <button type="button" class="border border-0 bg-transparent col-1 d-flex justify-content-center align-items-center" onclick="changeValue('minus'),updateTotal('minus')">-</button>
                    </div>
                    <div class="stock col-4 offset-2 d-flex justify-content-center py-1">
                        <p class="mb-0 text-center" id="stock" data-value="{{ $vehicle['stock'] }}"> Stok: {{ $vehicle['stock'] }}</p>
                    </div>
                </div>
                <div class="row d-flex mt-5">
                    <label  class="col-4 offset-1 ps-0 py-2" for="pengambilan">Pengambilan:</label>
                    <input class="col-5 border border-light-subtle rounded-3" type="date" id="pengambilan" name="pengambilan">
                </div>
                <div class="row d-flex mt-2 ">
                    <label  class="col-4 offset-1 ps-0 py-2" for="pengembalian">Pengembalian:</label>
                    <input class="col-5 border border-light-subtle rounded-3" type="date" id="pengembalian" name="pengembalian">
                </div>
                <div class="row d-flex mt-5 justify-content-center gap-3 ">
                    <p class="col-4">Sub Total</p>
                    <div class="col-5">
                        <label for="total" class="col-2 text-end">Rp </label>
                        <input  class=" col-9 border-0 " type="number" name="total" id="total" value="{{ $vehicle['charter_price'] }}">
                    </div>
                </div>
                <div class="col-4 offset-4 d-flex mt-5 justify-content-center gap-3">

                    <button class="btn btn-primary d-flex justify-content-start"  >booking</button>
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
