<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaItem extends Model
{
    protected $fillable = ['title', 'file_path', 'type', 'alt_text'];
}
