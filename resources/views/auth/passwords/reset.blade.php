@extends('layouts.login')

@section('content')
<form method="POST" action="{{ route('password.update') }}" class="bg-white shadow rounded p-8 mb-4">

  @csrf
  <input type="hidden" name="token" value="{{ $token }}">

  <h2 class="font-bold text-3xl text-gray-700 mb-2">Alteração de Senha</h2>
  <p class="mb-4 text-gray-600">Informe os dados para alterar a senha</p>

  @if ($errors->any())
    <div class="bg-red-100 text-red-500 px-3 py-2 rounded mb-3">
       @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
      @endforeach
    </div>
  @endif

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
      value="{{ $email ?? old('email') }}"  />
  </div>

  <div class="mb-3">
    <label class="form-label" for="password">
      {{ __('Senha') }}
    </label>
    <input 
      class="form-input @error('password') is-invalid @enderror" 
      id="password" 
      name="password" 
      type="password" 
      placeholder="{{ __('Senha') }}" 
      autocomplete="new-password"
      required>
    
  </div>

  <div class="mb-3">
    <label class="form-label" for="password-confirm">
      {{ __('Confirmação de Senha') }}
    </label>
    <input 
      class="form-input" 
      id="password-confirm" 
      name="password_confirmation" 
      type="password" 
      placeholder="{{ __('Confirmação de Senha') }}" 
      autocomplete="new-password"
      required>
    </div>

  <div class="my-8 text-center" style="margin-top: 50px;">
    <button type="submit" class="bg-blue-500 focus:outline-none focus:shadow-outline font-bold hover:bg-blue-700 px-4 py-2 rounded text-white w-full" >
      {{ __('Alterar senha') }}
    </button>
  </div>
</form>
@endsection