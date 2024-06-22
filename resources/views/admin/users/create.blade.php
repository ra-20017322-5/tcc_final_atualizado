@extends('admin.users.layouts.app')
@section('title', 'Incluir usuário')

@section('content')
    <h3>Incluir usuário</h3>

    <form action="{{ route('users.store') }}" method="POST">
        @include('admin.users.form')
    </form>
@endsection