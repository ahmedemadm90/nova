<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnfixedService extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'nid', 'job', 'licence_level', 'mobile', 'address', 'image',
        'blacklist', 'active', 'permit_id', 'company_id'
    ];
    public function company()
    {
        return $this->belongsTo(Service_Company::class, 'company_id');
    }
}