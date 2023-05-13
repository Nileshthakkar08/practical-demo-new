<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cities;


class Cities extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'cities';

    public static function getCities($stateId)
    {
        return Cities::where("state_id", $stateId)
                                    ->get(["name", "id"]);
    }
}
