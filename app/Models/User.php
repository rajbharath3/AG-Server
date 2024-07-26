<?php
// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use Laravel\Jetstream\HasProfilePhoto;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasProfilePhoto;

    protected $fillable = [
        'name',
        'role_id',
        'email',
        'password',
    ];

    // protected static function booted()
    // {
    //     static::creating(function ($user) {
    //         if (is_null($user->role_id)) {
    //             $role = Role::where('name', 'user')->first();
    //             if ($role) {
    //                 $user->role_id = $role->id;
    //             } 
    //         }
    //     });
    // }
}
