<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')All-Rent</title>
    <link rel="icon" href="img/about.png" type="image/png">
    <style>
        body{
            padding-top: 5%;
        }
        .navbar li {
            position: relative;
        }

        .navbar a {
            font-size: 1rem;
            padding: 10px 20px;
            color: var(--text-color);
            font-weight: 500;
            position: relative;
            /* Added for positioning pseudo-element */
        }

        .navbar a::after {
            content: "";
            width: 0;
            height: 3px;
            background: #fe5b3d;
            position: absolute;
            bottom: -4px;
            left: 0;
            transition: 0.5s;
        }

        .navbar a:hover::after {
            width: 100%;

        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    @include('sweetalert::alert')

    <section class="head fixed-top">
        <div
            class="container-fluid row col-12 py-2 mx-0 d-flex justify-content-between align-items-center bg-body-secondary">

            <div class="col-1">

                <a href="/"><img src="img/jeep.png" alt="" class="" width="50" height="50"></a>
            </div>
            <ul class="col-11 navbar mb-0 nav nav-pills d-flex justify-content-end gap-3" id="nav-pills">
                <li class="nav-item">
                    <a class="nav-link" href="/">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">Layanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">Tim Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">Hubungi Kami</a>
                </li>
            </ul>

            

        </div>
    </section>
@yield('login')
@yield('register')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>


</body>

</html>
