<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5">
  <title>Metronic · Dashboard (Dark/Light)</title>
  <!-- Font Awesome 6 (free) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Google Font (Inter) -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/style.css') }}">
  
  @stack('dashboard-style')  

</head>
<body>
  <!-- overlay for mobile -->
  <div class="overlay" id="overlay"></div>

  <!-- SIDEBAR -->
  @include('layouts.backend.sidebar')


  <!-- MAIN -->
  <div class="main">
    <!-- topbar -->
      @include('layouts.backend.topbar')


    <!-- KPI cards -->
      @yield('content')

  </div>

  <script src="{{ asset('assets/backend/js/dashboard.js') }}"></script>

  @stack('dashboard-script')


</body>
</html>