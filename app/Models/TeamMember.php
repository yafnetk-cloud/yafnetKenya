<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = ['name', 'title', 'group', 'bio', 'photo_path', 'linkedin_url', 'order', 'published'];
}
