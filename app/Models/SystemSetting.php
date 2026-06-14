<?php

namespace App\Models;

use App\Traits\HasUid;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    use HasUid;
    
    protected $fillable = ['id', 'created_at', 'updated_at'];
}