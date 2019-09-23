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
{{-- , #21c8f6, #3E3E54, #4E87EC --}}
<body>
  <div id="app" class="w-full">
    <div class="flex flex-wrap h-full w-full">
      <div class="w-full md:w-1/2" style="background: linear-gradient(180deg, #45A6E3, #4E87EC);">
        <div class="h-full mx-auto">
          <div class="flex flex-column space-between h-full">

            <div class="flex flex-1 justify-center items-center">
              <h1 class="font-bold text-center text-white">Logo</h1>
            </div>

            <div class="justify-center max-w-xl mx-auto w-full flex-1">
              @yield('content')
            </div>

            <div class="flex justify-center items-end flex-1 text-white pb-2">
              @ {{ Carbon\Carbon::now()->year }}. Todos os direitos reservados.
            </div>

          </div>
        </div>
      </div>
      
      <div class="hidden md:block md:w-1/2 bg-gray-200">
        <div class="h-full flex flex-column justify-center">
          <div class="container mx-auto">
            <img src="{{ asset('assets/images/ideas_flow.svg') }}" alt="" class="w-3/4 mx-auto">
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>