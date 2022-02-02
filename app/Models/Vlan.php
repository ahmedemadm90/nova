<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vlan extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'gateway', 'switch_id', 'start_ip', 'end_ip', 'active'];
    public function cameras($id)
    {
        $camera_count = Camera::where('vlan_id', $id)->count();
        return $camera_count;
    }
    public function switch()
    {
        return $this->belongsTo(Dispatch::class, 'switch_id');
    }
}