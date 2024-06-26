<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssetStoreRequest;
use App\Http\Requests\AssetUpdateRequest;
use App\Models\Asset;
use App\Models\AssetCategorie;
use App\Models\AssetType;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index() 
    {   
        $assets = Asset::paginate(20);
        $asset_type = AssetType::orderBy('name', 'ASC')->get();
        $asset_categorie = AssetCategorie::orderBy('name', 'ASC')->get();

        return view('admin.assets.index', compact('assets'));
    }
    
    public function create() 
    {   
        $types = AssetType::orderBy('name', 'ASC')->get();
        $categories = AssetCategorie::orderBy('name', 'ASC')->get();
        return view('admin.assets.create', compact('types','categories'));
    }
    
    public function store(AssetStoreRequest $request) 
    {   
        
        if( ! Asset::create( $request->validated() ) ){
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
        return view('admin.assets.edit', compact('asset','types','categories'));

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
