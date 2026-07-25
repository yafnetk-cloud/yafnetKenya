<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    protected $fillable = ['type', 'name', 'email', 'phone', 'subject', 'message', 'meta', 'is_read'];
    protected $casts = ['meta' => 'array', 'is_read' => 'boolean'];
}
