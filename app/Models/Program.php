<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = ['pillar_id', 'title', 'slug', 'is_flagship', 'summary', 'body', 'components', 'image_path', 'order', 'published'];
    protected $casts = ['components' => 'array', 'is_flagship' => 'boolean'];

    public function pillar() { return $this->belongsTo(Pillar::class); }
}
