<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    
    protected $table = "upload_complements";
    
    protected $fillable = [
        'action_description',
        'action_status',
        'allocated_at',
        'observation',
    ];
}
