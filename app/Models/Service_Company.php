<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service_Company extends Model
{
    use HasFactory;
    protected $table  = 'service_companies';
    protected $fillable = ['company_name', 'active', 'owner'];
}