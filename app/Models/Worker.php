<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'name', 'position', 'title_id', 'vp_id', 'area_id', 'type_id', 'company_id',
        'state', 'worker_manager_id', 'img', 'country_id', 'location_id', 'area_res'
    ];
    public function title()
    {
        return $this->belongsTo(Title::class, 'title_id');
    }
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
    public function vp()
    {
        return $this->belongsTo(Vp::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function worker_manager()
    {
        return $this->belongsTo(Worker::class, 'worker_manager_id');
    }
    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}