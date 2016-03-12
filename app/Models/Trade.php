<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
	public function trades()
	{
		$this->belongsToMany('App\Models\User', 'user_trades', 'user_id', 'trade_id');
	}
}
