<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'two_factor_enabled', 'two_factor_secret'];
    protected $hidden = ['password', 'remember_token', 'two_factor_secret'];

    public function isSuperAdmin(): bool { return $this->role === 'super_admin'; }
    public function isEditor(): bool { return $this->role === 'editor'; }
}
