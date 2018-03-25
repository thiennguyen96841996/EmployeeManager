<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VacationFulltime extends Model
{
	const waitting = 0;
	const approve = 1;
    const refuse = 2;
    
	use SoftDeletes;
	protected $dates = ['deleted_at'];

    public function user() {
    	return $this->belongsTo(User::class);
    }
}
