<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    @yield('title')
</head>
<body>
    {{-- <section class="header" >
        <div class="navbar d-flex justify-content-lg-between  ">

            <a href="/" class="logo"><img src="img/jeep.png" alt="logo"></a>
            
            <div class="bx bx-menu" id="menu-icon"></div>
            
        <ul class="nav-item d-flex text-decoration-none">
            <li><a href="#Overview">Overview</a></li>
            <li><a href="#Layanan">Layanan</a></li>
            <li><a href="#TimKami">Tim Kami</a></li>
            <li><a href="#HubungiKami">Hubungi Kami</a></li>
        </ul>
        
        <div class="header-btn">
            <a href="{{ route('register') }}" class="Register">Register</a>
            <a href="{{ route('login') }}" class="Login">Login</a>
        </div>
    </div>
</section> --}}
<section class="header">
    <nav class="navbar d-flax navbar-expand-lg navbar-dark bg-dark justify-content-between">
        <div class="logo">

            <a href="/" class="navbar-brand"><img src="img/jeep.png" alt="logo" style="width: 40px;"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </div>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#Overview">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Layanan">Layanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#TimKami">Tim Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#HubungiKami">Hubungi Kami</a>
                </li>
            </ul>
            
        </div>
        <div class="auth">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
                </li>
            </ul>
        </div>
    </nav>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
</body>
</html>