@extends('layouts.app')

@section('breadcrumb')
  <breadcrumb active="Usuários"></breadcrumb>
@endsection

@section('content')
  <users-table :prop-users="{{ $users ?? [] }}"></users-table>
@endsection