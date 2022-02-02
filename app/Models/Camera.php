<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    use HasFactory;
    protected $fillable = [
        'code', 'region', 'segment', 'location', 'area', 'en_name', 'ar_name', 'is_operation', 'switch_id', 'vlan_id', 'dvr_id',
        'type', 'brand', 'model', 'serial', 'ip', 'username', 'password', 'resolution', 'maintenance', 'clean', 'connection',
        'power', 'company', 'year', 'install_state', 'state', 'alarm'
    ];

    public function dvr()
    {
        return $this->belongsTo(DVR::class, 'dvr_id');
    }
    public function vlan()
    {
        return $this->belongsTo(Vlan::class, 'vlan_id');
    }
    public function dispatch()
    {
        return $this->belongsTo(Dispatch::class, 'switch_id');
    }
}