@extends('layouts.login')

@section('content')
  <form method="POST" action="{{ route('login') }}" class="bg-white shadow rounded p-8 mb-4">

    @csrf

    <h2 class="font-bold text-3xl text-gray-700 mb-2">Bem Vindo</h2>
    <p class="mb-4 text-gray-600">Para acessar sua conta, informe os dados abaixo</p>

    @error('email')
      <div class="bg-red-100 text-red-500 px-3 py-2 rounded mb-3">{{ $message }}</div>
    @enderror

    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
        {{ __('Email') }}
      </label>
      <input 
        autocomplete="email" 
        class="form-input shadow-md @error('email') is-invalid @enderror" 
        id="email" 
        placeholder="{{ __('Email') }}"
        name="email"
        required 
        type="email" 
        value="{{ old('email') }}" 
        autofocus>

    </div>

    <div class="mb-8" >
      <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
        {{ __('Senha') }}
      </label>
      <input 
        class="form-input shadow-md @error('email') is-invalid @enderror" 
        id="password" 
        placeholder="{{ __('Senha') }}"
        name="password"
        type="password" 
        required>
    </div>

    <div class="mb-3" style="margin-top: 50px;">
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
@endsection