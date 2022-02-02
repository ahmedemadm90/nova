<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnfixedPermit extends Model
{
    use HasFactory;
    //protected $table = 'unfixed_permits';
    protected $fillable = [
        'workers_names', 'ar_workers_names', 'workers_ids', 'company_id', 'start_date',
        'end_date', 'active', 'requested_by', 'state', 'group_id', 'expire',
        'is_approved', 'state_change_by', 'state_change_time',
        'is_safety_approved', 'safety_state_change_by', 'safety_state_change_time',
        'is_security_approved', 'security_state_change_by', 'security_state_change_time',
    ];
    protected $casts = [
        'workers_names' => 'array',
        'ar_workers_names' => 'array',
        'workers_ids' => 'array',
    ];
    public function company()
    {
        return $this->belongsTo(Service_Company::class, 'company_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }
}
