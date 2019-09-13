@extends('layouts.app')

@section('breadcrumb')
  <breadcrumb 
    :items="[{ title: 'Empresas', uri: '/companies' },]" 
    active="{{ isset($company) ? 'Editar' : 'Nova' }} Empresa">
  </breadcrumb>
@endsection

@section('content')

@endsection