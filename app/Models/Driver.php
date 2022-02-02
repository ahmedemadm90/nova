<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'license_level', 'license_number', 'phone_number', 'state', 'id_img', 'company_id', 'active', 'permit_id'];
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}