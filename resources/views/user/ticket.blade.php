@extends('template.templateUser')
@section('main')    


@foreach ($ticket as $tickets)
{{-- @dd($tickets) --}}
<p> {{ $tickets->detail_booking_id }}</p>
<p> {{ $tickets->Vehicle->name}}</p>
@endforeach

<h1>INI TIKET</h1>
<div class="section">
    <div class="card row col-6 offset-3 ">
        <div class="col">
            <h1 class=" text-center">Detail Booking</h1>
        </div>
        <div class="col">
            
        </div>

    </div>
</div>
@endsection