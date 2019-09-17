@extends('layouts.app')

@section('breadcrumb')
  <breadcrumb 
    :items="[{ title: 'Empresas', uri: '/companies' },]" 
    active="{{ isset($company) ? 'Editar' : 'Nova' }} Empresa">
  </breadcrumb>
@endsection

@section('content')
<div>
  <form method="POST" 
    action="{{ isset($company) ? route('companies.update', $company) : route('companies.store') }}" 
    class="bg-white shadow-md rounded pb-8 mb-4">

    @csrf

    @isset($company)
      @method('PUT')
    @endisset

    <div class="px-8 py-2 bg-gray-300 text-gray-600">
      Dados da Empresa
    </div>

    <div class="pt-6 px-8">
      <div class="flex flex-wrap">
        <div class="form-group md:px-2 md:w-1/2">
          <label class="form-label required" for="name">
            Nome
          </label>
          <input 
            class="form-input" 
            id="name" 
            name="name"
            type="text"
            value="{{ $company->name ?? old('name') }}" 
            placeholder="Nome da Empresa" 
            required>
        </div>

        <div class="form-group md:px-2 md:w-1/2">
          <label class="form-label" for="name">
            ID Integração
          </label>
          <input 
            class="form-input" 
            id="integrationId" 
            name="integration_id"
            type="text"
            value="{{ $company->integration_id ?? old('integration_id') }}" 
            placeholder="ID para integração">
        </div>
      </div>

      <location 
        prop-state="{{ $company->state ?? old('state') }}"
        prop-city="{{ $company->city ?? old('city') }}">
      </location>
    
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