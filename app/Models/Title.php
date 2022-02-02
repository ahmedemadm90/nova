<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;
    protected $fillable = ['title_name'];
    public function workers()
    {
        return $this->hasMany(Worker::class);
    }
}