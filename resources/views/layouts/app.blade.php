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

      <aside id="sidebar" class="sidebar lg:h-auto lg:block lg:relative inset-0">
        <div id="logo" class="flex items-center justify-center logo text-center text-white">
          <h1 class>{{ config('app.name', 'Laravel') }}</h1>
        </div>

        <div class="h-full navigation overflow-y-auto scrolling-touch">
          <ul class="text-white">
            <li>
            <a href="{{ route('home') }}">Home</a></li>
            <navigation-group 
              title="Configurações" 
              active="{{ Request::is(['users*', 'companies*']) ?? false }}">
              <li class="{{ Request::is('companies*') ? 'active' : null }}">
                <a href="{{ route('companies.index') }}">Empresas</a>
              </li>
              <li class="{{ Request::is('users*') ? 'active' : null }}">
                <a href="{{ route('users.index') }}">Usuários</a>
              </li>
            </navigation-group>
          </ul>
        </div>
      </aside>

      <section class="w-full h-full">
        <header id="header" class="bg-white header"></header>
        
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