<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Styles -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
  <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
  <div id="app" class="bg-gray-100">

    <div class="flex flex-1 w-full h-full overflow-hidden">

      @include('sidebar')

      <section class="w-full h-full">
        <header id="header" class="bg-white header flex items-center w-full">
          <div class="flex flex-1 justify-end items-center">
            <div>
              {{ auth()->user()->name }}
            </div>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button class="btn btn-link flex" type="submit">
                <i class="material-icons">exit_to_app</i>
              </button>
            </form>
          </div>
        </header>
        
        @yield('breadcrumb')

        <main class="py-4 overflow-scroll h-full w-full">
          <div class="container mx-auto px-4">
            @yield('content')
          </div>
        </main>
      </section>
    </div>
    
    @include('alerts')
    
  </div>
</body>
</html>