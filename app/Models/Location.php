<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = ['location_name', 'country_id'];
    public function workers()
    {
        return $this->hasMany(Worker::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}