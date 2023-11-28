<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            padding-top: 5%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row card d-flex flex-row mt-5 align-items-center gap-3">
            <div class="col-4  d-flex flex-column">
                <header>
                    <h5 class="text-center">ID Ticket : {{ $tickets->detail_booking_id }}</h5>
                </header>

                <body>
                    <img src="{{ $tickets->vehicle->vehicle_photo }}" alt="kendaraan" height="300px" width="300px">
                </body>
                
            </div>
            <div class="col-6 ">
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Nama Pemesan</th>
                            <td>: {{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Nama Kendaraan</th>
                            <td>: {{ $tickets->vehicle->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Jumlah Kendaraan</th>
                            <td>: {{ $tickets->qty }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Tanggal Pengambilan</th>
                            <td>: {{ $tickets->pickup_date }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Tanggal Pengembalian</th>
                            <td>: {{ $tickets->return_date }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Harga Sewa / Hari</th>
                            <td>: Rp. {{ $tickets->vehicle->charter_price }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Jumlah Hari</th>
                            <td>: {{ $tickets->day }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Alamat Toko</th>
                            <td>: {{ $admin->address }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Harga Sewa Total</th>
                            <td>: Rp. {{ $tickets->price_total_charter }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
