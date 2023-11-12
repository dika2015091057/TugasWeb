@extends('template.templateUser')
@section('main')
<header>
    <div class="col-3 offset-3">

       <p> <a  href="/" class=" text-decoration-none text-base mt-3">Dashboard</a>> </p>
    </div>
</header>
    <div class="container-fluid d-flex flex-column gap-5">
        <div class="container">

            <form action="{{ route('type', ['type' => '']) }}" method="GET">
                <div class="card d-flex flex-lg-row justify-content-around gap-2 shadow col-10 offset-1 flex-wrap py-4 mt-3">
                    <div class="card col-2 justify-content-center align-items-center bg-primary"><a class=" text-decoration-none text-white text-center" href="/">Semua</a></div>
                    <button class="btn btn-primary col-2 offset-1" name="type" value="mobil">mobil</button>
                    <button class="btn btn-primary col-2" name="type" value="motor">motor</button>
                    <button class="btn btn-primary col-2" name="type" value="sepeda">sepeda</button>
                </div>
            </form>
        </div>
        <div class="container d-flex flex-column gap-5">
            <div class="container-card d-flex flex-wrap gap-2 justify-content-center">
                @foreach ($vehicles as $vehicle)
                    <div class="col-3">
                        <form method="GET" action="{{ route('detail', ['id' => $vehicle->vehicle_id]) }}">
                            @csrf
                            <div class="card shadow-sm">
                                <button type="submit" class="border-0">
                                    <img class=" " width="100%" height="225" src="{{ $vehicle->vehicle_photo }}">
                                </button>
                                <div class="card-body">
                                    <p class="card-text text-center">{{ $vehicle->name }}</p>
                                    <p class="card-text text-center">{{ $vehicle->charter_price }}\Hari</p>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="text-body-secondary col d-flex justify-content-end">stok: {{ $vehicle->stock }}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="container">

            {{ $vehicles->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
