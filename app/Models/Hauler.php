<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hauler extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'active'];
    public function trucks($id)
    {
        $trucksCount = Truck::where('hauler_id', $id)->count();
        return $trucksCount;
    }
}