<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pillar extends Model
{
    protected $fillable = ['title', 'slug', 'icon', 'summary', 'body', 'image_path', 'order', 'published'];

    public function programs() { return $this->hasMany(Program::class); }
}
