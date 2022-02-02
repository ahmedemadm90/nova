<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnfixedFromSupplier extends Model
{
    use HasFactory;
    protected $fillable = ['en_name','ar_name','job','nid','phone1','phone2','address','gender','company','birthdate','age'];
}
