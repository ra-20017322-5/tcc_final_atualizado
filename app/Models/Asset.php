<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'avaiable_at',
        'asset_categorie',
        'asset_type',
        'name',
        'serial_number',
        'tag',
        'patrimonial_id',
        'observation',
    ];
}
