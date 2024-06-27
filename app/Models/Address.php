<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Address extends Model
{
    use HasFactory;
    
    protected $table = 'addresses';
    
    
    public static function store(string $user_id)
    {
        $sql = DB::table('addresses AS adr')
            ->selectraw('adr.*,stt.name state_name, city.name city_name')
            ->where('adr.user_id', $user_id)
            ->leftJoin('country_states AS stt', 'adr.state', 'stt.id')
            ->leftJoin('country_cities AS city', 'adr.city', 'city.id')
            ->orderBy('adr.id', 'DESC')
            ->get();
        
            return $sql;
    }
    
    public static function getAllByIdUser(string $user_id)
    {
        $sql = DB::table('addresses AS adr')
            ->selectraw('adr.*,stt.name state_name, city.name city_name')
            ->where('adr.user_id', $user_id)
            ->leftJoin('country_states AS stt', 'adr.state', 'stt.id')
            ->leftJoin('country_cities AS city', 'adr.city', 'city.id')
            ->orderBy('adr.id', 'DESC')
            ->get();
        
            return $sql;
    }
}
