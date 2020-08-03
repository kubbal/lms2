<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LMS') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Bootstrap -->
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/cover/">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <link href="{{ asset('css/cover.css') }}" rel="stylesheet">
</head>
<body class="text-center">

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
      <header class="masthead mb-auto">
        <div class="inner">
          <h3 class="masthead-brand">{{ config('app.name', 'LMS') }}</h3>
          <nav class="nav nav-masthead justify-content-center">
            @guest
            <a class="nav-link" id="nav-1" href="/">Főoldal</a>
            @endguest
            @php
            $user = Auth::user();
            if($user != null) {
              if($user->isTeacher == 0) {
                echo "<a class='nav-link' id='nav-10' href='/studenthome'>Tárgyaim (Diák)</a>";
                echo "<a class='nav-link' id='nav-11' href='/targyfelvetel'>Tárgy felvétele</a>";
                echo "<a class='nav-link' id='nav-12' href='/tasklist'>Feladatok listája</a>";
                } else {
                  echo "<a class='nav-link' id='nav-8' href='/teacherhome'>Tárgyaim (Tanár)</a>";
                  echo "<a class='nav-link' id='nav-9' href='/newsubject'>Új tárgy meghirdetése</a>";
              }
            }
            
            @endphp
            <a class="nav-link" id="nav-2" href="/contact">Kapcsolat</a>
            @guest
            <a class="nav-link" id="nav-3" href="/login">Belépés</a>
            <a class="nav-link" id="nav-4" href="/register">Regisztráció</a>
            @else
            <a class="nav-link" id="nav-5" href="/profile">Profil</a>
            <!-- Logout -->
            <a class="nav-link" id="nav-6" href="{{ route('logout') }}" onclick="handleLogoutClick()">
              Kilépés
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
            <!-- EOF Logout -->
            @endguest
          </nav>
        </div>
      </header>

      <main role="main" class="inner cover">
        @yield('content')
      </main>

      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>Cover template for <a href="https://getbootstrap.com/">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
        </div>
      </footer>
    </div>

    <script>
    function handleLogoutClick() {
      event.preventDefault(); 
      document.getElementById('logout-form').submit();
    }
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>