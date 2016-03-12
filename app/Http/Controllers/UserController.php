<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

	public function getUserById($id)
	{
		$user = User::find($id);

		if(is_null($user))
		{
			return response()->json([], 404);
		}
		else
		{
			return response()->json($user, 200);
		}
	}

	public function getUserPerformance($id)
	{

	}

	public function postUser(Request $request)
	{
		try {
			$user = new User();

			$user->first_name = $request->get('first_name');
			$user->last_name = $request->get('last_name');
			$user->email = $request->get('email');
			$user->password = bcrypt($request->get('password'));
			$user->balance = $request->get('balance');
			$user->created_at = date('Y-m-d');

			$user->save();

			return response()->json($user->id, 200);
		}
		catch(\Exception $ex)
		{
			return response()->json([], 400);

		}
	}

	public function updateUserPerformance($id)
	{

	}
}