<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
    
    protected $table = "country_states";
    
    protected $fillable = [
        'id',
        'name',
        'code_national',
    ];
}
