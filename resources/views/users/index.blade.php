@extends('layouts.app')

@section('breadcrumb')
  <breadcrumb active="Usuários"></breadcrumb>
@endsection

@section('content')
  <user-table :prop-users="{{ $users ?? [] }}"></user-table>
@endsection