
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Droghers-hub</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inlander+Rough&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,-25" />
    <script src="{{ asset('resources/js/main.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }} ">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body class="antialiased" style="background-color: #f1f1f1 !important; background-image: url('{{ asset('images/background.jpg') }}') !important;">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <nav class="navbar navbar-expand-lg navbar-light logo-container "  style="margin: 0; padding: 0; box-shadow: none;">

    <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

  <a href="{{ route('users.index') }}" >Users</a>
  <a href="{{ route('products.index') }}" >Products</a>
  <a href="{{ route('brands.index') }}" >Brands</a>
  <a href="{{ route('categories.index') }}" >Categories</a>
  <a href="{{ route('contacts.index') }}" >Contacts</a>
  <a href="{{ route('orders.index') }}">Orders</a>
  <a href="{{ route('banners.index') }}">Banners</a>
  <a href="{{ route('usermanual.index') }}" class="btn-rounded" style="width: 70px;">
    <img src="{{ asset('images/help.png') }}" width="38" height="38" alt="Help">
</a>

</div>

<!-- Use any element to open the sidenav -->
@if (Route::has('login'))
@auth
<span onclick="openNav()">
    <img src="{{ asset('images/menuone.png') }}" alt="Open" width="35" height="30" >
</span>
@endauth
@endif

<!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->

<div class="container-fluid align-items-center d-flex logo-container">
    <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ URL('images/logo.png') }}" class="img-fluid" width="200" height="300" alt="Contact List Image">
    </a>

    @include('layouts.navigation')
</div>



    </nav>

    <script>
    // Set the width of the side navigation to 250px
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
    }

    // Set the width of the side navigation to 0
    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }
  </script>
    @yield('content')

</body>

</html>
