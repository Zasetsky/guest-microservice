<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Guest extends Model
{
	use HasFactory;

	protected $keyType = 'string';
	public $incrementing = false;

	protected $fillable = [
		'first_name',
		'last_name',
		'email',
		'phone',
		'country',
	];

	protected static function boot()
	{
		parent::boot();

		static::creating(function ($model) {
			if (empty($model->id)) {
				$model->id = (string) Str::uuid();
			}
		});
	}
}
