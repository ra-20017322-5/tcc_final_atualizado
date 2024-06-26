<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssetStoreRequest;
use App\Http\Requests\AssetUpdateRequest;
use App\Models\Asset;
use App\Models\AssetCategorie;
use App\Models\AssetType;
use App\Models\UploadGet;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index() 
    {   
        $assets = Asset::paginate(50);
        $asset_type = AssetType::orderBy('name', 'ASC')->get();
        $asset_categorie = AssetCategorie::orderBy('name', 'ASC')->get();

        return view('admin.assets.index', compact('assets','asset_type','asset_categorie'));
    }
    
    public function create() 
    {   
        $types = AssetType::orderBy('name', 'ASC')->get();
        $categories = AssetCategorie::orderBy('name', 'ASC')->get();
        return view('admin.assets.create', compact('types','categories'));
    }
    
    public function store(AssetStoreRequest $request) 
    {   
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        
        if( ! Asset::create( $data ) ){
            return back()
            ->with('message','Campos com * são obrigatórios!');
        }
        return redirect()
            ->route('assets.index')
            ->with('message','Usuário criado com sucesso!');
    }
    
    
    public function edit(string $id) 
    {   
        if( ! $asset = Asset::find($id) ){
            return redirect()
                ->route('assets.index')
                ->with('message','Usuário não encontrado!');
        }
        
        $types = AssetType::orderBy('name', 'ASC')->get();
        $categories = AssetCategorie::orderBy('name', 'ASC')->get();
        $photosGalery = UploadGet::findAllByTypeAndReference($asset->id,9);
        $contracts = UploadGet::findAllByTypeAndReference($asset->id,6);
        return view('admin.assets.edit', compact('asset','types','categories','photosGalery','contracts'));

    }
    
    public function update(AssetUpdateRequest $request, string $id) 
    {   
        if( ! $asset = Asset::find($id) ){
            return back()
                ->with('message','Usuário não encontrado!');
        }
        
        $data = $request->only(
            'avaiable_at',
            'asset_categorie',
            'asset_type',
            'name',
            'serial_number',
            'tag',
            'patrimonial_id',
            'observation',
        );
        
        $asset->update($data);
        
        return redirect()
            ->route('assets.index')
            ->with('message','Salvo com sucesso!');
    }
}
