<?php

namespace App\Http\Controllers;

use Illuminate\Database\Schema\IndexDefinition;
use Illuminate\Http\Request;

class AwsUploadController extends Controller
{
    public function index()
    {
        return view('admin.upload.index');
    }
    
    public function store(Request $request)
    {
        dd($request->file);
    }
}
