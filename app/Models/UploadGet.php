<?php

namespace App\Models;

use App\Http\Requests\UploadStoreRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UploadGet extends Model
{
    use HasFactory;
    
    protected $table = "uploads";
    
    protected $s3Bucket = "tcc-upload/";
    
    #Uploads por tipo e ID de referencia, com dados adicionais
    public static function findAllByTypeAndReference(string $reference_id, string $upload_type)
    {
        $sql = DB::table('uploads AS up')
            ->selectraw('up.*,upsts.name up_status, upc.action_description, upc.action_status, upc.allocated_at, upc.observation, us.name user_upload, usap.name user_approved')
            ->leftJoin('upload_complements AS upc', 'up.id','=', 'upc.upload_id')
            ->leftJoin('users AS us', 'up.user_id', 'us.id')
            ->leftJoin('users AS usap', 'upc.user_id', 'usap.id')
            ->leftJoin('status AS upsts', 'up.status', 'upsts.id')
            ->where('up.reference_id', $reference_id)
            ->where('up.upload_type', $upload_type)
            ->where('up.status', 1)
            ->orderBy('up.id', 'DESC')
            ->get();
        
            return $sql;
    }
    
    #Uploads por tipo e com dados adicionais
    public static function findAllByType(string $upload_type)
    {
        $sql = DB::table('uploads AS up')
            ->selectraw('up.*,upsts.name up_status, upc.action_description, upc.action_status, upc.allocated_at, upc.observation, us.name user_upload, usap.name user_approved')
            ->leftJoin('upload_complements AS upc', 'up.id','=', 'upc.upload_id')
            ->leftJoin('users AS us', 'up.user_id', 'us.id')
            ->leftJoin('users AS usap', 'upc.user_id', 'usap.id')
            ->leftJoin('status AS upsts', 'up.status', 'upsts.id')
            ->where('up.upload_type', $upload_type)
            ->where('up.status', 1)
            ->orderBy('up.id', 'DESC')
            ->get();
        
            return $sql;
    }
    
    #Dados do upload
    public static function findById(string $upload_id)
    {
        $sql = DB::table('uploads AS up')
            ->selectraw('up.*')
            ->where('up.id', $upload_id)
            ->get();
        
            return $sql;
    }


    #Recuperar dowloads
    public static function getUploadUsers(string $upload_id)
    {
        #Return dados
        $upload = Self::findById($upload_id);
        return Storage::disk('s3')
                ->get('tcc-final/users/'.$upload->file_name_uploaded);
    }
    
    public static function getUploadAssets(string $upload_id)
    {
        #Return dados
        $upload = Self::findById($upload_id);
        return Storage::disk('s3')
                ->get('tcc-final/assets/'.$upload->file_name_uploaded);
    }
}
