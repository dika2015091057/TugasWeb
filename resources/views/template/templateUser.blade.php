<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
          body{
            padding-top: 5%;
        }


    </style>
</head>

<body>
    {{-- sesion header --}}
        <header class="py-3 mb-3 border-bottom fixed-top bg-white">
            <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 2fr 6fr 1fr 1fr;">
                <div class="col-1">
                    <a href="/"><img src="img/jeep.png" alt="" class="" width="50" height="50"></a>
                </div>
                <div class="d-flex align-items-center">
                    <form class="w-100 me-3" role="search" action="{{ route('search') }}">
                        <input type="search" class="form-control" placeholder="Search..." aria-label="Search" name="search">
                    </form>
                </div>
                <div class="flex  d-flex justify-content-end ">
                    <a href="/bookings" class="d-block link-body-emphasis text-decoration-none">
                        <img src="img/booking.png" alt="mdo" width="50" height="50"
                            class=" img-fluid">
                    </a>
                </div>
                <div class="flex  d-flex justify-content-end ">
                    <a href="/profile" class="d-block link-body-emphasis text-decoration-none">
                        <img src="{{ Auth::user()->photo_profile }}" alt="m" width="50" height="50"
                            class="rounded-circle shadow shadow-sm ">
                    </a>
                </div>
            </div>
        </header>
    {{--  --}}
    <main>
        @yield('main')
    </main>
    <footer>
        @yield('footer')
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    

</body>

</html>
