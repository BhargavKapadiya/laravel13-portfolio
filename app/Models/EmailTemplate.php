<?php

namespace App\Models;

use App\Traits\HasUid;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasUid;
    
    protected $fillable = ['title', 'subject', 'body'];
}