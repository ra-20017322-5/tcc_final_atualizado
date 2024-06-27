<?php

namespace App\Models;

use App\Http\Requests\UploadStoreRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class UploadAws extends Model
{
    use HasFactory;
    
    protected $table = "uploads";
    
    protected $fillable = [
            'user_id',
            'upload_type',
            'reference_id',
            'uuid',
            'file_size',
            'file_name',
            'file_name_uploaded',
            'observation',
            'status',
        ];
}
