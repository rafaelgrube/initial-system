@extends('layouts.login')

@section('content')
<div class="h-full mx-auto">
  <div class="flex flex-column space-between h-full">

    <div class="flex flex-1 justify-center items-center">
      <h1 class="font-bold text-center text-white">Logo</h1>
    </div>

    <div class="justify-center max-w-xl mx-auto w-full flex-1">
      <form method="POST" action="{{ route('login') }}" class="bg-white shadow rounded p-8 mb-4">

        @csrf

        <h2 class="font-bold text-3xl text-gray-700 mb-2">Bem Vindo</h2>
        <p class="mb-4 text-gray-600">Para acessar sua conta, informe os dados abaixo</p>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
            {{ __('Usuário') }}
          </label>
          <input 
            autocomplete="email" 
            class="form-input shadow-md @error('email') is-invalid @enderror" 
            id="username" 
            placeholder="{{ __('Usuário') }}"
            name="email"
            required 
            type="text" 
            value="{{ old('email') }}" 
            autofocus>

            @error('email')
              <p class="form-input-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-8" style="margin-bottom: 50px;">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
            {{ __('Senha') }}
          </label>
          <input 
            class="form-input shadow-md @error('password') is-invalid @enderror" 
            id="password" 
            placeholder="{{ __('Senha') }}"
            name="password"
            type="password" 
            required>

            @error('password')
              <p class="form-input-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
          <button 
            class="bg-blue-500 focus:outline-none focus:shadow-outline font-bold hover:bg-blue-700 px-4 py-2 rounded text-white w-full" 
            type="submit">
            Entrar
          </button>
        </div>

        <div class="text-center">
          <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Esqueceu sua senha?') }}
          </a>
        </div>

      </form>
    </div>

    <div class="flex justify-center items-end flex-1 text-white pb-2">
      @ {{ Carbon\Carbon::now()->year }}. Todos os direitos reservados.
    </div>
  </div>
</div>
@endsection