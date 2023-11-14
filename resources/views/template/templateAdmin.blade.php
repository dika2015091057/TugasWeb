<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')All-Rent</title>

    <link rel="icon" href="img/about.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="admin\style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>


<body>
    <div class="grid-container">
        <section class="header">
            <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 3fr 1fr;">
                <div class="head d-flex align-items-center justify-content-start -mr-3">
                    <p>selamat datang {{ Auth::user()->username }} <span id="greeting"></span></p>

                </div>
                <div class="d-flex align-items-center justify-content-end">
                    <div class="flex-shrink-0 dropdown">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32"
                                class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu text-small shadow">

                            <li><a class="dropdown-item" href="/adminprofile">Profile </a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <form action="{{ route('logout') }}" method="POST" class="d-flex">
                                @csrf
                                @method('DELETE')
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <div class="logo  me-5">
            <a href="/"
                class="d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto py-2 text-white text-decoration-none">
                <img src="img/jeep.png" alt="" class="img-fluid rounded-circle  " width="100px" height="100px">
            </a>
        </div>
        <div class="sidebar d-flex flex-column p-3 me-5 justify-content-center align-items-center" style="width:300px;">
            <ul class="nav nav-pills d-flex flex-column mb-auto gap-5  justify-content-center"
                style="height: 60%;width:80%;">
                <li class="nav-item text-start ps-1">
                    <a href="/" class="nav-link text-black-50 border @yield('dashboard') ">
                        <i class="fa-solid fa-house"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item text-start ps-1">
                    <a href="/booking" class="nav-link text-black-50 border  @yield('booking')">
                        <i class="fa-solid fa-briefcase"></i> Manage Booking
                    </a>
                </li>
                <li class="nav-item text-start ps-1">
                    <a href="/vehicle" class="nav-link text-black-50 border  @yield('vehicle')">
                        <i class="fa-solid fa-warehouse"></i> Manage Kendaraan
                    </a>
                </li>
                <li class="nav-item text-start ps-1">
                    <a href="/adminprofile" class="nav-link text-black-50 border  @yield('profile')">
                        <i class="fa-solid fa-user"></i> Profile
                    </a>
                </li>
            </ul>
        </div>

        <div class="main">
            @yield('main')
            <footer>
                <p class="mb-0">&copy;2023 | Kelompok 6</p>

            </footer>
        </div>
    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
        // Dapatkan waktu saat ini dari browser pengguna
        var time = new Date().getHours();

        // Tentukan ucapan berdasarkan waktu
        var greeting = "";
        if (time < 12) {
            greeting = "Semoga tetap cuan Pagi ini!";
        } else if (time < 15) {
            greeting = "Semoga tetap cuan Siang ini!";
        } else if (time < 19) {
            greeting = "Semoga tetap cuan Sore ini!";
        } else {
            greeting = "Semoga tetap cuan Malam ini!";

        }

        // Tampilkan ucapan selamat yang sesuai
        document.getElementById("greeting").innerHTML = greeting;
    </script>
</body>

</html>
