@extends('template.templateAdmin')
@section('vehicle', 'active')

@section('main')
    <section class="row gap-4 me-2">

        {{-- Section header Body --}}
        <section class="card row shadow" style="background-color: #F5F5F5;">
            <div class="col-12 head-card mb-3 mt-1">
                <h2>Tambah Kendaraan</h2>
                <p><a href="/" class="text-black text-decoration-none">Home</a> > <a href="/vehicle"
                        class="text-decoration-none text-black">Manage Kendaraan</a> > <a href="" class="text-decoration-none">Tambah Kendaraan</a>
                    </p>
            </div>
            <div class="container d-flex flex-wrap justify-content-center pb-3">
                <section class="slider_container mt-5">
                    <div class="container shadow-sm p-2">
                        <div class="swiper card_slider">
                            <div class="swiper-wrapper">
    
                                @foreach ($vehicles as $vehicle)
                                    <div class="swiper-slide">
                                        <form action="{{ route('detail', ['id' => $vehicle->vehicle_id]) }}" method="get"
                                            class="d-flex  justify-content-center">
                                            @csrf
                                            <button type="submit" class="border-0 text-decoration-none p-0 rounded">
                                                <div class="card" style="height: 100%; width:100%;">
                                                    <div class="card">
                                                        <img src="{{ $vehicle->vehicle_photo }}" alt="" height="200px" class=" rounded">
                                                    </div>
                                                    <div class="border ">
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
                        </div>
                    </div>
    
                </section>
            </div>
        </section>
        {{-- Section create --}}
        <section class="card row">
            <form class="was-validated">
                <div class="mb-3">
                  <label for="validationTextarea" class="form-label">Textarea</label>
                  <textarea class="form-control" id="validationTextarea" placeholder="Required example textarea" required></textarea>
                  <div class="invalid-feedback">
                    Please enter a message in the textarea.
                  </div>
                </div>
              
                <div class="form-check mb-3">
                  <input type="checkbox" class="form-check-input" id="validationFormCheck1" required>
                  <label class="form-check-label" for="validationFormCheck1">Check this checkbox</label>
                  <div class="invalid-feedback">Example invalid feedback text</div>
                </div>
              
                <div class="form-check">
                  <input type="radio" class="form-check-input" id="validationFormCheck2" name="radio-stacked" required>
                  <label class="form-check-label" for="validationFormCheck2">Toggle this radio</label>
                </div>
                <div class="form-check mb-3">
                  <input type="radio" class="form-check-input" id="validationFormCheck3" name="radio-stacked" required>
                  <label class="form-check-label" for="validationFormCheck3">Or toggle this other radio</label>
                  <div class="invalid-feedback">More example invalid feedback text</div>
                </div>
              
                <div class="mb-3">
                  <select class="form-select" required aria-label="select example">
                    <option value="">Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                  <div class="invalid-feedback">Example invalid select feedback</div>
                </div>
              
                <div class="mb-3">
                  <input type="file" class="form-control" aria-label="file example" required>
                  <div class="invalid-feedback">Example invalid form file feedback</div>
                </div>
              
                <div class="mb-3">
                  <button class="btn btn-primary" type="submit" >Submit form</button>
                </div>
              </form>
        </section>


    </section>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".card_slider", {
            slidesPerView: '4', // Jumlah slide yang ditampilkan
            // spaceBetween: 30, // Spasi antar slide
            direction: 'horizontal', // Atur arah swiper menjadi horizontal
            loop: false, // Untuk membuat efek loop
            allowTouchMove: true,


        });
    </script>
@endsection
