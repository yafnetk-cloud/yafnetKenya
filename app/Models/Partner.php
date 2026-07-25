<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = ['name', 'category', 'logo_path', 'website_url', 'order', 'published'];
}
