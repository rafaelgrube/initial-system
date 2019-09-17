@extends('layouts.app')

@section('breadcrumb')
  <breadcrumb 
    :items="[{ title: 'Usuários', uri: '/users' }]" 
    active="{{ isset($user) ? 'Editar' : 'Novo' }} Usuário">
  </breadcrumb>
@endsection

@section('content')
<div>

  <form method="POST" action="{{ isset($user) ? route('users.update', $user->login) : route('users.store') }}" class="bg-white shadow-md rounded pb-8 mb-4">

    @csrf

    @isset($user)
      @method('PUT')
    @endisset

    <div class="px-8 py-2 bg-gray-300 text-gray-600">
      Dados do Usuário
    </div>

    <div class="pt-6 px-8">
      <div class="flex flex-wrap">
        <div class="form-group md:px-2 md:w-1/2">
          <label class="form-label required" for="name">
            Nome Completo
          </label>
          <input 
            class="form-input" 
            id="name" 
            name="name"
            type="text"
            value="{{ $user->name ?? old('name') }}" 
            placeholder="Nome Completo" 
            required>
        </div>

        <div class="form-group md:px-2 md:w-1/2 ">
          <label class="form-label required" for="login">
            Login
          </label>
          <input 
            class="form-input" 
            id="login" 
            name="login" 
            type="text" 
            value="{{ $user->login ?? old('login') }}" 
            placeholder="Login" 
            required>
        </div>
      </div>

      <div class="flex flex-wrap">
        <div class="form-group md:px-2 md:w-1/2">
          <label class="form-label {{ empty($user) ? 'required' : null }}" for="password">
            Senha
          </label>
          <input 
            class="form-input @error('password') is-invalid @enderror" 
            id="password" 
            name="password" 
            type="password" 
            placeholder="Senha" 
            {{ empty($user) ? 'required' : null }}>
          
          @error('password')
            <p class="form-input-error">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-group md:px-2 md:w-1/2 ">
          <label class="form-label {{ empty($user) ? 'required' : null }}" for="password_confirmation">
            Confirmação de Senha
          </label>
          <input 
            class="form-input" 
            id="passwordConfirmation" 
            name="password_confirmation" 
            type="password" 
            placeholder="Confirmação de Senha" 
            {{ empty($user) ? 'required' : null }}>
        </div>
      </div>

      <div class="form-group md:px-2 md:w-1/2">
        <label class="form-label required" for="email">
          Email
        </label>
        <input 
          class="form-input" 
          id="email" 
          name="email" 
          type="email" 
          value="{{ $user->email ?? old('email') }}" 
          placeholder="Email" 
          required>
      </div>
    
      <div class="mx-2">
        <button 
          type="submit"
          class="bg-green-500 hover:bg-green-700 hover:shadow text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-3">
          Salvar
        </button>
      </div>
    </div>
  </form>

</div>
@endsection