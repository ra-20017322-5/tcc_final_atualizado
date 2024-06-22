<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index() 
    {   
        #retoorno simples
        // $user = User::first();
        // return view('admin.users.index', compact('user'));
        
        #Listagem
        // $users = User::all(); //Tras todos os registros
        
        $users = User::paginate(20);
        return view('admin.users.index', compact('users'));
    }
    
    public function create() 
    {   
        #Listagem
        // $users = User::all(); //Tras todos os registros
        
        // $users = User::paginate(20);
        return view('admin.users.create');
    }
    
    public function store(StoreUserRequest $request) 
    {   
        User::create( $request->validated() );
        return redirect()
            ->route('users.index')
            ->with('success','Usuário criado com sucesso!');
    }
    
    public function edit(string $id) 
    {   
        if( ! $user = User::find($id) ){
            return redirect()
                ->route('users.index')
                ->with('message','Usuário não encontrado!');
        }
        
        return view('admin.users.edit', compact('user'));
    }
    
    public function update(UpdateUserRequest $request, string $id) 
    {   
        if( ! $user = User::find($id) ){
            return back()
                ->with('message','Usuário não encontrado!');
        }
        
        $data = $request->only('name', 'email');
        
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        
        $user->update($data);
        
        return redirect()
            ->route('users.index')
            ->with('success','Salvo com sucesso!');
    }
        
    public function show(string $id) 
    {   
        if( ! $user = User::find($id) ){
            return redirect()
                ->route('users.index')
                ->with('message','Usuário não encontrado!');
        }
        
        return view('admin.users.show', compact('user'));
    }
        
    public function delete(string $id) 
    {   
        if( ! $user = User::find($id) ){
            return redirect()
                ->route('users.index')
                ->with('message','Usuário não encontrado!');
        }
        
        if( Auth::user()->id === $user->id ){
            return back()->with('message','Você nçao pode excluir seu próprio perfil!');
        }
        
        $user->delete();
        
        return redirect()
            ->route('users.index')
            ->with('success','Excluído com sucesso!');
    }
}
