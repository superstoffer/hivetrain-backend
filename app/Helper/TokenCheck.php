<?php

namespace App\Helper;

use App\Models\User;
use Illuminate\Http\Request;

class TokenCheck
{
	public static function check(Request $request, $id)
	{
		$user = User::find($id);

		if(is_null($user))
		{
			return 404;
		}

		if ($user->token != $request->get('token')) {
			return 401;
		}

		return 200;
	}
}