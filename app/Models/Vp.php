<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vp extends Model
{
    use HasFactory;
    protected $fillable = ['vp_name', 'region_id'];
    public function area()
    {
        return $this->hasMany(Area::class);
    }
    public function workers()
    {
        return $this->hasMany(Worker::class);
    }
}