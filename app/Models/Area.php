<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = ["area_name", "vp_id"];
    public function vp()
    {
        return $this->belongsTo(Vp::class);
    }
    public function workers()
    {
        return $this->hasMany(Worker::class);
    }
}