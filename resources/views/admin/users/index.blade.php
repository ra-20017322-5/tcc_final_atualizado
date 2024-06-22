@extends('admin.users.layouts.app')

@section('title', 'Listagem de usuários')

@section('content')
    <h3>Listagem de usuários</h3>
    
    <x-alert/>
    
    <a href="{{ route('users.create') }}" class="btn btn-primary">Novo</a>
    
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Ação</th>
            </tr>
        </thead>
        
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td><a href="{{route('users.edit', $user->id)}}">Edit</a></td>
                    <td><a href="{{route('users.show', $user->id)}}">View</a></td>
                </tr>
            @empty
                <tr><td colspan="100">Nenhum usuario cadastrado!</td></tr>
            @endforelse
        </tbody>
    </table>
    
    {{ $users->links() }}
    
@endsection

<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>