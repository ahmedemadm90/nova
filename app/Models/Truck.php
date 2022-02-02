<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;
    protected $fillable = ['truck_no', 'hauler_id', 'state'];
    public function hauler()
    {
        return $this->belongsTo(Hauler::class, 'hauler_id');
    }
}