<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DVR extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'type', 'install_location', 'region', 'location', 'area', 'brand', 'model',
        'sw_ver', 'code', 'total_chs', 'hdd_cap', 'unit_cap', 'total_storage', 'qty', 'ip',
        'username', 'password', 'active'
    ];
    public function cameras()
    {
        return $this->hasMany(Camera::class);
    }
    public function available_chs($id)
    {
        $dvr = DVR::find($id);
        $camera_count = Camera::where('dvr_id', $id)->count();
        $available_chs = $dvr->total_chs - $camera_count;
        if ($available_chs > 0) {
            return $available_chs;
        }
        return "$dvr->name Is Full";
    }
}