@extends('admin.users.layouts.app')

@section('title', 'Editar usuário')

@section('content')
    <h3>Editar usuário</h3>
    
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @method('put')
        @include('admin.users.form')
    </form>
@endsection