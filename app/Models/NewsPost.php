<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsPost extends Model
{
    protected $fillable = ['title', 'slug', 'category', 'excerpt', 'body', 'featured_image', 'author_id', 'status', 'published_at'];
    protected $casts = ['published_at' => 'datetime'];

    public function author() { return $this->belongsTo(User::class, 'author_id'); }

    public function scopePublished($q)
    {
        return $q->where('status', 'published')->where(function ($q2) {
            $q2->whereNull('published_at')->orWhere('published_at', '<=', now());
        });
    }
}
