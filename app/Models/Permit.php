<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    use HasFactory;
    protected $fillable = [
        'type', 'date_from', 'date_to', 'vehicle_num', 'vehicle_type', 'vehicle_clr',
        'drivers_count','vehicle_drivers_id','company_id', 'mission', 'access_gate', 'allowed_sectors',
        'movement_gates', 'permit_by', 'state','safety','security', 'group_id', 'expire',
        'is_approved', 'state_change_by', 'state_change_time',
        'is_safety_approved', 'safety_state_change_by', 'safety_state_change_time',
        'is_security_approved', 'security_state_change_by', 'security_state_change_time',
    ];
    protected $casts = [
        'access_gate' => 'array',
        'allowed_sectors' => 'array',
        'movement_gates' => 'array',
        'vehicle_drivers_id' => 'array',
        'state' => 'array',
        'safety' => 'array',
        'security' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'permit_by');
    }
    public function driver($nid)
    {
        //$driver = UnfixedService::whereIn('job',['driver','سائق'])->where('nid', $nid)->first();
        $driver = UnfixedService::where('nid', $nid)->first();
        return $driver;
    }
}
