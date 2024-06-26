@extends('admin/layouts/app')

@section('title', 'Detalhes do usuários')

@section('content')
    <h3>Detalhes de usuários</h3>
    
    
    <ul>
        <li>Nome: {{$user->name}}</li>
        <li>E-mail: {{$user->email}}</li>
    </ul>
    
    <form action="{{ route('users.delete', $user->id) }}" method="POST">
        @csrf
        @method('delete')
        <button type="submit">Excluir</button>
    </form>
@endsection