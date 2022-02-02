<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'group_id',
        'groups',
        'roles_name',
    ];
    protected $hidden = [
        'password',
    ];
    protected $casts = [
        'groups' => 'array',
    ];
    public function worker()
    {
        return $this->belongsTo(Worker::class, 'id');
    }
    public function group($id)
    {
        $group = Group::where('id', $id)->first();
        return $group;
    }
    public function permits()
    {
        return $this->hasMany(Permit::class);
    }
}