@extends('layouts.login')

@section('content')
<form method="POST" action="{{ route('password.email') }}" class="bg-white shadow rounded p-8 mb-4">
  
  @csrf

  <h2 class="font-bold text-3xl text-gray-700 mb-2">Recuperar Senha</h2>
  <p class="mb-4 text-gray-600">Você receberá todas as intruções de recuperação no seu email</p>

  @error('email')
    <div class="bg-red-100 text-red-500 px-3 py-2 rounded mb-3">{{ $message }}</div>
  @enderror

  <div class="mb-3">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
      {{ __('Email') }}
    </label>
    <input 
      autocomplete="email" 
      autofocus
      class="form-input shadow-md @error('email') is-invalid @enderror" 
      id="email" 
      name="email" 
      placeholder="{{ __('Email') }}"
      required
      type="email" 
      value="{{ old('email') }}" />
  </div>

  @if (session('status'))
    <p class="text-green-500 text-lg" role="alert">
      {{ session('status') }}
    </p>
  @endif

  <div class="my-8 text-center" style="margin-top: 40px;">
    <button type="submit" class="bg-blue-500 focus:outline-none focus:shadow-outline font-bold hover:bg-blue-700 px-4 py-2 rounded text-white w-full mb-3" >
      {{ __('Enviar link de recuperação de senha') }}
    </button>

    <div class="text-center">
      <a class="btn btn-link text-gray-600 hover:text-gray-700" href="{{ route('login') }}">Voltar</a>
    </div>
  </div>

  
</form>
@endsection