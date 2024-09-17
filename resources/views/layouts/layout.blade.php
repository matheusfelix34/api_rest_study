<!DOCTYPE html>
<html>
<head>
  <title>Assessment</title>
  <link rel="stylesheet" type="text/css" href={{ mix('css/app.css') }} >
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href=" {{ url('/profile') }}">Profile</a></li>
        <li><a href=" {{ url('/report') }}">Reports</a></li>
      </ul>
    </nav>
  </header>
  
  <main>
    @yield('content')
   
  </main>

  <script src={{ mix('js/app.js') }}></script>
  @stack('scripts')
</body>
</html>
