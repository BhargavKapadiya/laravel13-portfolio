<?php

namespace App\Models;

use App\Traits\HasUid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FAQs extends Model
{

	use HasUid, SoftDeletes;

	protected $table = "faqs";

	protected $fillable = [
		'question', 'answer',
	];

	protected $dates = ['deleted_at'];
}