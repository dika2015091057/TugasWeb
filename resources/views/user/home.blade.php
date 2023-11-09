@extends('template.templateUser')
@section('main')
    <div class="container-fluid d-flex flex-column gap-5">
        <div class="container">

            <form action="{{ route('type', ['type' => '']) }}" method="GET">
                <div class="card d-flex flex-lg-row justify-content-around gap-2 shadow col-10 offset-1 flex-wrap py-4 mt-3">
                    <button class="btn btn-primary col-2" name="type" value="Jenis">Jenis</button>
                    <button class="btn btn-primary col-2 offset-1" name="type" value="mobil">mobil</button>
                    <button class="btn btn-primary col-2" name="type" value="motor">motor</button>
                    <button class="btn btn-primary col-2" name="type" value="sepeda">sepeda</button>
                </div>
            </form>
        </div>
        <div class="container d-flex flex-column gap-5">
            <div class="container-card d-flex flex-wrap gap-2 justify-content-center">
                @foreach ($vehicles as $vehicle)
                    <div class="card d-flex flex-column gap-2 col-3 px-1 py-1">
                        <form method="GET" action="{{ route('detail', ['id' => $vehicle->vehicle_id]) }}">
                            @csrf
                            <button type="submit" class="image-container d-flex p-0 border-0 ">
                                <img src="{{ $vehicle->vehicle_photo }}" alt="Vehicle" class="img-fluid rounded ">
                            </button>
                        </form>
                        <div class="footer">
                            <h3><span style="font-weight: bold;">Marque :</span> {{ $vehicle->name }}</h3>
                            <p><span style="font-weight: bold;">Marque :</span> {{ $vehicle->charter_price }}/Hari</p>
                           
                        </div>
                    </div>
                    {{-- <div class="card col-lg-3 col-md-4 col-sm-6 col-12 px-1 py-1 " style="height: 400px;">
                        <form method="GET" action="{{ route('detail', ['id' => $vehicle->vehicle_id]) }}">
                            @csrf
                            <button type="submit" class="image-container d-flex py-0 border border-0 " style="height: 100px;">
                                <img src="{{ $vehicle->vehicle_photo }}" alt="Vehicle" class="img-fluid rounded" style="object-fit: cover; width: 300px; height:100% ;">
                            </button>
                        </form>
                        <div class="footer">
                            <h3><span style="font-weight: bold;">Marque :</span> {{ $vehicle->name }}</h3>
                        </div>
                    </div> --}}
                    
                @endforeach
            </div>
        </div>
        <div class="container">

            {{ $vehicles->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
