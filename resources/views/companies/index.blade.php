@extends('layouts.app')

@section('breadcrumb')
  <breadcrumb active="Empresas"></breadcrumb>
@endsection

@section('content')
  <company-table :prop-companies="{{ $companies ?? [] }}"></company-table>
@endsection