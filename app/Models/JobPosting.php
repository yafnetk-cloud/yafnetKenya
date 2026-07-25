<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    protected $fillable = ['title', 'type', 'location', 'description', 'closing_date', 'published'];
    protected $casts = ['closing_date' => 'date'];
}
