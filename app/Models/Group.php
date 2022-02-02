<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ["group_name", "users_id"];
    /* public function users()
    {
        return $this->hasMany(User::class, 'users_id');
    } */
    public function users($id)
    {
        $users = User::where('groups', 'like', "%$id%")->get();
        return $users;
    }
    protected $casts = [
        'users_id' => 'array',
    ];
}