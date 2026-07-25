<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImpactStat extends Model
{
    protected $fillable = ['label', 'value', 'suffix', 'icon', 'order'];
}
