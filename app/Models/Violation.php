<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'vp_id', 'area_id', 'location', 'date', 'time', 'category', 'involved_ids',
        'involved_names', 'involved_pos', 'involved_comps', 'involved_types', 'area_res_id',
        'nearmiss', 'description', 'action', 'gallery', 'video', 'classification', 'safety_comment', 'valid'
        ,'register_by'
    ];
    protected $casts = [
        'involved_ids' => 'array',
        'involved_names' => 'array',
        'involved_pos' => 'array',
        'involved_comps' => 'array',
        'involved_types' => 'array',
        'gallery' => 'array',
    ];
    public function vp()
    {
        return $this->belongsTo(Vp::class);
    }
    public function operator()
    {
        return $this->belongsTo(User::class,'register_by');
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function area_res()
    {
        return $this->belongsTo(Worker::class, 'area_res_id');
    }
    public function vioType()
    {
        return $this->belongsTo(ViolationType::class, 'classification');
    }
}
