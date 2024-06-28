<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UploadAws;
use App\Models\UploadGet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContractUploadController extends Controller
{
    /**
        Contrato é um upload de um Asset
    */
    public function index(string $reference_id)
    {
        #Return dados
        $contracts = UploadGet::findAllByTypeAndReference($reference_id,6);
        return view('admin.assets_contract.index',compact('reference_id','contracts'));
    }
    
    public function store(Request $request)
    {
        $file = $request->file('file');
        $file_size = $request->file('file')->getSize();
        $file_name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $file_name_uploaded = md5(uniqid().microtime().uniqid()).'.'.$extension;
        
        $result = $file->storeAs('assets/', $file_name_uploaded, 's3');
        
        if( ! $result )
        {
            return back()
                ->with('message','FALHA AO ENVIAR PARA O BUCKET NA AWS S3');
        }
        
        $data = $request->only(
            'reference_id',
            'upload_type',
        );
        $data['user_id'] = Auth::user()->id;
        $data['file_size'] = $file_size;
        $data['file_name'] = $file_name;
        $data['file_name_uploaded'] = $file_name_uploaded;
        $data['uuid'] = Str::uuid()->toString();
        $data['file_size'] = $file_size;

        if( ! UploadAws::create( $data ) ){
            return back()
            ->with('return_success','FALHOU AO SALVAR O UPLOAD!');
        }
        
        #Return dados
        $reference_id = $data['reference_id'];
        $contracts = UploadGet::findAllByTypeAndReference($data['reference_id'], $data['upload_type']);
        
        $return_success = 'ARQUIVO ENVIADO COM SUCESSO!';
        return view('admin.assets_contract.index',compact('reference_id','contracts','return_success'));
    }
}
