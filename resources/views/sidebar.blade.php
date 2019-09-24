<aside id="sidebar" class="sidebar lg:h-auto lg:block lg:relative inset-0">
  <div id="logo" class="flex items-center justify-center logo text-center text-white">
    <h1 class>{{ config('app.name', 'Laravel') }}</h1>
  </div>

  <div class="h-full navigation overflow-y-auto scrolling-touch">
    <ul class="text-white">
      <li class="{{ Route::is('home') ? 'active' : null }}">
        <a href="{{ route('home') }}">Home</a>
        @can('update-alert')

        @endcan
      </li>
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