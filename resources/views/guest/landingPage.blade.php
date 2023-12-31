<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent-All</title>
    <link rel="icon" href="img/about.png" type="image/png">
    <link rel="stylesheet" href="stylelanding.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

</head>

<body>

    <header>
        <a href="/" class="logo"><img src="img/jeep.png" alt=""></a>

        <div class="bx bx-menu" id="menu-icon"></div>

        <ul class="navbar">
            <li><a href="#Overview">Overview</a></li>
            <li><a href="#Layanan">Layanan</a></li>
            <li><a href="#TimKami">Tim Kami</a></li>
            <li><a href="#HubungiKami">Hubungi Kami</a></li>
        </ul>

        <div class="header-btn">
            <a href="{{ route('register') }}" class="Register">Register</a>
            <a href="{{ route('login') }}" class="Login">Login</a>
        </div>

    </header>

    <section class="Overview" id="Overview">
        <div class="text">
            <h1><span>Looking</span> to <br>Rent-All</h1>
            <p>Rent-All adalah sebuah sistem informasi penyewaan motor, mobil, dan sepeda
                yang terintegrasi. Sistem ini dapat digunakan oleh pelanggan untuk melakukan pemesanan, pembayaran,
                dan pengambilan kendaraan secara online. Sistem ini juga dapat digunakan oleh pengelola rental untuk
                mengelola stok kendaraan, transaksi, dan laporan.</p>
            <div class="app-stores">
                <img src="img/ios.png" alt="">
                <img src="img/512x512.png" alt="">
            </div>
        </div>
    </section>

    <section class="Layanan" id="Layanan">
        <div class="heading">
            <h1>Layanan</h1>
        </div>
        <div class="Layanan-container">
            <div class="box">
                <i class='bx bx-cycling'></i>
                <h2>1. Penyewaan Sepeda Motor</h2>
            </div>

            <div class="box">
                <i class='bx bxs-car'></i>
                <h2>2. Penyewaan Mobil</h2>
            </div>

            <div class="box">
                <i class='bx bx-cycling'></i>
                <h2>3. Penyewaan Sepeda</h2>
            </div>
        </div>
    </section>

    <section class="TimKami" id="TimKami">
        <div class="heading">
            <h1>Tim Kami</h1>
        </div>
        <div class="TimKami-container">
            <div class="box">
                <div class="rev-img">
                    <img src="img/rev1.jpg" alt="">
                </div>
                <h2>Ekinnisura Kaban</h2>
            </div>

            <div class="box">
                <div class="rev-img">
                    <img src="img/rev1.jpg" alt="">
                </div>
                <h2>Wahyu Yuda</h2>
            </div>

            <div class="box">
                <div class="rev-img">
                    <img src="img/rev1.jpg" alt="">
                </div>
                <h2>Dika Rama</h2>
            </div>
        </div>
    </section>

    <section class="HubungiKami" id="HubungiKami">
        <div class="heading">
            <h1>Hubungi Kami</h1>
        </div>

        <div class="HubungiKami-container">

            <div class="logo-img">
                <img src="img/jeep.png" alt="">
            </div>

            <div class="box">
                <h2>Perusahaan</h2>
                <p>Tentang Kami</p>
                <p>Karir</p>
                <h2>Lainnya</h2>
                <p>Syarat & Ketentuan</p>
                <p>Kebijakan Privasi</p>
            </div>

            <div class="box">
                <h2>Alamat</h2>
                <p>Jl. Udayana No.23 Kec. Buleleng</p>
                <p>Kab. Buleleng, Bali 81115</p>
                <p>Phone : 0821-2023-2321</p>
                <p>Email : rentalall@gmai.com</p>
            </div>
        </div>
    </section>

    <section class="copyright">
        <p>Hak Cipta@ 2023</p>
        <div class="social">
            <a href="https://www.facebook.com/" target="_blank"><i class='bx bxl-facebook'></i></a>
            <a href="https://www.twitter.com/" target="_blank"><i class='bx bxl-twitter'></i></a>
            <a href="https://www.instagram.com/" target="_blank"><i class='bx bxl-instagram'></i></a>
            <a href="https://www.youtube.com/" target="_blank"><i class='bx bxl-youtube'></i></a>
        </div>
    </section>



    <script src="main.js"></script>
</body>

</html>
