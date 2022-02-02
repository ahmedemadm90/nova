<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnfixedCompany extends Model
{
    protected $fillable = ['company_name'];
    use HasFactory;
}