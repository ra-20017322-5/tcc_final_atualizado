<x-alert/>

@csrf
<input type="text" name="name" placeholder="Nome do Usuário" value="{{$user->name ?? old('name')}}">
<input type="email" name="email" placeholder="E-mail" value="{{$user->email ?? old('email')}}">

{{-- @if( ! $user ) --}}
<input type="password" name="password" placeholder="Senha">
{{-- @endif --}}
<button>Salvar</button>
