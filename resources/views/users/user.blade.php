@extends('layouts.app')

@section('breadcrumb')
  <breadcrumb 
    :items="[{ title: 'Usuários', uri: '/users' }]" 
    active="{{ isset($user) ? 'Editar' : 'Novo' }} Usuário">
  </breadcrumb>
@endsection

@section('content')
<div>

  <form method="POST" action="{{ isset($user) ? route('users.update', $user->username) : route('users.store') }}" class="bg-white shadow-md rounded pb-8 mb-4">

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
            required
            autocomplete="name">
        </div>

        <div class="form-group md:px-2 md:w-1/2 ">
          <label class="form-label required" for="username">
            Login
          </label>
          <input 
            class="form-input" 
            id="username" 
            name="username" 
            type="text" 
            value="{{ $user->username ?? old('username') }}" 
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
            {{ empty($user) ? 'required' : null }}
            autocomplete="new-password">
          
          @error('password')
            <p class="form-input-error">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-group md:px-2 md:w-1/2 ">
          <label class="form-label {{ empty($user) ? 'required' : null }}" for="password-confirm">
            Confirmação de Senha
          </label>
          <input 
            class="form-input" 
            id="password-confirm" 
            name="password_confirmation" 
            type="password" 
            placeholder="Confirmação de Senha" 
            {{ empty($user) ? 'required' : null }}>
        </div>
      </div>

      <div class="flex flex-wrap">
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

        <div class="form-group md:px-2 md:w-1/2">
          <label class="form-label required" for="role">Grupo</label>
          <select name="role_id" id="role" class="form-select form-input" required>
            <option disabled selected>Selecione um grupo</option>
            @foreach ($roles as $role)
              <option value="{{ $role->id }}" {{ isset($user->role_id) && $user->role_id === $role->id ? 'selected' : null }}>
                {{ $role->name }}
              </option>
            @endforeach
          </select>
        </div>
      </div>
    
      <div class="flex flex-wrap items-center mx-2 mt-8">
        <button 
          type="submit"
          class="bg-green-500 hover:bg-green-700 hover:shadow text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mb-2 mr-3">
          Salvar
        </button>

        @isset($user)
          <user-companies :user="{{ $user }}" :companies="{{ $companies }}" class="mb-2"></user-companies>
        @endisset
      </div>
    </div>
  </form>

  <div>
    
  </div>

</div>
@endsection