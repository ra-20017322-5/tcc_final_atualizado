<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Address;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index() 
    {   
        $users = User::paginate(20);
        $user_types = UserType::orderBy('name', 'ASC')->get();
        return view('admin.users.index', compact('users','user_types'));
    }
    
    public function create() 
    {   
        // $estados = Estado::orderBy('name', 'ASC')->get();
        // return view('admin.users.create', ['estados'=>$estados]);
        return view('admin.users.create');
    }
    
    public function store(StoreUserRequest $request) 
    {   
        if( ! User::create( $request->validated() ) ){
            return back()
            ->with('message','Campos com * são obrigatórios!');
        }
        return redirect()
            ->route('users.index')
            ->with('message','Usuário criado com sucesso!');
    }
    
    public function edit(string $id) 
    {   
        if( ! $user = User::find($id) ){
            return redirect()
                ->route('users.index')
                ->with('message','Usuário não encontrado!');
        }
        
        $addresses = Address::getAllByIdUser($id);
        return view('admin.users.edit', compact('user','addresses'));
    }
    
    public function update(UpdateUserRequest $request, string $id) 
    {   
        if( ! $user = User::find($id) ){
            return back()
                ->with('message','Usuário não encontrado!');
        }
        
        $data = $request->only(
            'name',
            'email',
            'cellphone',
            'telephone',
            'personal_id_primary',
            'personal_id_secundary',
            'driver_id'
        );
        
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
            return back()
                ->with('message','Usuário não encontrado!');
        }

        return view('admin.users.show',compact('user'));
    }
    
    public function resetPassword(UpdateUserRequest $request, string $id) 
    {   
        if( ! $user = User::find($id) ){
            return back()
                ->with('message','Usuário não encontrado!');
        }
                
        #encryptar a senha
        $encrypt = bcrypt($request->password);
        
        $sql = DB::update('UPDATE users SET password = ? WHERE id = ?', [$encrypt, $id] );
        if( $sql )
            $msg = 'Senha alterada com sucesso!';
        else
            $msg = 'Sem alteração!';
            
        return redirect()
            ->route('users.index')
            ->with('success',$msg);
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
