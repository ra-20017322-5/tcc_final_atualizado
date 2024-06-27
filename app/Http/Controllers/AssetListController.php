<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\AssetCategorie;
use App\Models\AssetType;

class AssetListController extends Controller
{
    public function index() 
    {   
        $assets = Asset::paginate(50);
        $asset_type = AssetType::orderBy('name', 'ASC')->get();
        $asset_categorie = AssetCategorie::orderBy('name', 'ASC')->get();

        return view('assets_wheel', compact('assets','asset_type','asset_categorie'));
    }
}
