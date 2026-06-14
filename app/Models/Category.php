<?php

namespace App\Models;

use App\Traits\HasUid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasUid, SoftDeletes;

    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];
}