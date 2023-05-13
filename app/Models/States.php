<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\States;

class States extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'states';


    public static function getStates()
    {
        return States::get(["name", "id"]);
    }


}
