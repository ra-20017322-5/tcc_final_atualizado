<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContractStoreRequest;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index() 
    {   

        return view('admin.contracts.index');
    }
    
    public function store(ContractStoreRequest $request, string $id) 
    {   
        if( ! $user =Contract::find($id) ){
            return back()
                ->with('message','Usuário não encontrado!');
        }
        
        $data = $request->only(
            'user_id',
            'upload_id',
            'cellphone',
            'action_description',
            'action_status',
            'alocated_at',
            'observation'
        );

        $user->store($data);
        
        return redirect()
            ->route('contracts.index')
            ->with('success','Salvo com sucesso!');
    }
}
