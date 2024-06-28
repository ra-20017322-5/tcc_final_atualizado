<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadStoreRequest;
use App\Models\UploadAws;
use App\Models\UploadGet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AssetGaleryController extends Controller
{
    public function index(string $reference_id)
    {
        #Return dados
        $photosGalery = UploadGet::findAllByTypeAndReference($reference_id,9);
        return view('admin.assets_galery.index',compact('reference_id','photosGalery'));
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
            ->with('message','FALHOU AO SALVAR O UPLOAD!');
        }
        
        #Return dados
        $reference_id = $data['reference_id'];
        $photosGalery = UploadGet::findAllByTypeAndReference($data['reference_id'], $data['upload_type']);
        
        $return_success = 'ARQUIVO ENVIADO COM SUCESSO!';
        return view('admin.assets_galery.index',compact('reference_id','photosGalery','return_success'));
    }
    
    public function statusChange(string $upload_id,string $status)
    {
        if( ! $upload_id || ! $status ){
            return back()
                ->with('status', false)
                ->with('message','FALHA AO PASSAR PARÂMETRO!');
        }
        
        return back()
            ->with('status', true)
            ->with('message',"STATUS ALTERADO PARA: !");
    }
    
    public function delete(string $upload_id)
    {
    
        if( ! $upload_id ){
            return response()->json([
                'status'=>false,
                'message'=>'FALHA AO PASSAR PARÂMETRO!',
            ]);
        }
        
        
        $sql = DB::update('UPDATE uploads SET status = ? WHERE id = ?', [3, $upload_id] );

        if($sql > 0){
            return response()->json([
                'status'=>true,
                'message'=>'ARQUIVO EXCLUÍDO!',
            ]);
        }else{
            return response()->json([
                'status'=>true,
                'message'=>'JÁ EXCLUÍDO!',
            ]);
        }
    }
}
