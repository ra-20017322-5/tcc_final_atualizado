<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContractStoreRequest;
use App\Models\Contract;
use App\Models\UploadGet;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index() 
    {   
        $contracts = UploadGet::findAllByType(6);
        return view('admin.contracts.index', compact('contracts'));
    }
    
    public function store(ContractStoreRequest $request, string $id) 
    {   
        if( ! $contract = Contract::find($id) ){
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

        $contract->store($data);
        
        return redirect()
            ->route('contracts.index')
            ->with('success','Salvo com sucesso!');
    }
}
