<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

	private $headers = [
		'Access-Control-Allow-Origin' => '*',
	];

	public function getUserById($id)
	{
		$user = User::find($id);

		if(is_null($user))
		{
			return response()->json([], 404, $this->headers);
		}
		else
		{
			return response()->json($user, 200, $this->headers);
		}
	}

	public function getUserPerformance($id)
	{
		$user = User::find($id);

		if(is_null($user))
		{
			return response()->json([], 404, $this->headers);
		}
		else
		{
			return response()->json($user->performance, 200, $this->headers);
		}
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

			return response()->json($user->id, 200, $this->headers);
		}
		catch(\Exception $ex)
		{
			return response()->json([], 400, $this->headers);
		}
	}

	public function updateUserPerformance(Request $request, $id)
	{
		$user = User::find($id);

		if(is_null($user))
		{
			return response()->json([], 404, $this->headers);
		}
		else
		{
			$user->performance = $request->get('performance');
			$user->save();

			return response()->json($user->id, 200, $this->headers);
		}
	}
}