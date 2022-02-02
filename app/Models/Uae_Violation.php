<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uae_Violation extends Model
{
    use HasFactory;
    protected $table = 'uae_violations';
    protected $fillable = [
        'type', 'vp_id', 'area_id', 'date', 'time', 'description', 'action',
        'gallery', 'video', 'classification', 'involved_ids', 'involved_names','register_by','valid'
    ];
    protected $casts = [
        'gallery' => 'array',
        'involved_ids' => 'array',
        'involved_names' => 'array',
    ];
    public function vp()
    {
        return $this->belongsTo(Vp::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function vioType()
    {
        return $this->belongsTo(ViolationType::class, 'classification');
    }
    public function operator()
    {
        return $this->belongsTo(User::class, 'register_by');
    }

}
